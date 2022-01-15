<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\Sprinkle\Account\Account\Registration;
use UserFrosting\Sprinkle\Account\Controller\Exception\SpammyRequestException;
use UserFrosting\Sprinkle\Account\Facades\Password;
use UserFrosting\Sprinkle\Core\Util\Captcha;

/**
 * Controller class for /account/* URLs.  Handles account-related activities, including login, registration, password recovery, and account settings.
 */
class AuthController
{
    /**
     * Processes an account login request.
     *
     * Processes the request from the form on the login page, checking that:
     * 1. The user is not already logged in.
     * 2. The rate limit for this type of request is being observed.
     * 3. Email login is enabled, if an email address was used.
     * 4. The user account exists.
     * 5. The user account is enabled and verified.
     * 6. The user entered a valid username/email and password.
     * This route, by definition, is "public access".
     *
     * AuthGuard: false
     * Route: /account/login
     * Route Name: {none}
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function login(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface $currentUser */
        $currentUser = $this->ci->currentUser;

        /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
        $authenticator = $this->ci->authenticator;

        // Return 200 success if user is already logged in
        if ($authenticator->check()) {
            $ms->addMessageTranslated('warning', 'LOGIN.ALREADY_COMPLETE');

            return $response->withJson([], 200);
        }

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Get POST parameters
        $params = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema('schema://requests/login.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.  Failed validation attempts do not count towards throttling limit.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);

            return $response->withJson([], 400);
        }

        // Determine whether we are trying to log in with an email address or a username
        $isEmail = filter_var($data['user_name'], FILTER_VALIDATE_EMAIL);

        // Throttle requests

        /** @var \UserFrosting\Sprinkle\Core\Throttle\Throttler $throttler */
        $throttler = $this->ci->throttler;

        $userIdentifier = $data['user_name'];

        $throttleData = [
            'user_identifier' => $userIdentifier,
        ];

        $delay = $throttler->getDelay('sign_in_attempt', $throttleData);
        if ($delay > 0) {
            $ms->addMessageTranslated('danger', 'RATE_LIMIT_EXCEEDED', [
                'delay' => $delay,
            ]);

            return $response->withJson([], 429);
        }

        // If credential is an email address, but email login is not enabled, raise an error.
        // Note that this error counts towards the throttling limit.
        if ($isEmail && !$config['site.login.enable_email']) {
            $ms->addMessageTranslated('danger', 'USER_OR_PASS_INVALID');
            $throttler->logEvent('sign_in_attempt', $throttleData);

            return $response->withJson([], 403);
        }

        // Try to authenticate the user.  Authenticator will throw an exception on failure.
        /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
        $authenticator = $this->ci->authenticator;

        try {
            $currentUser = $authenticator->attempt(($isEmail ? 'email' : 'user_name'), $userIdentifier, $data['password'], $data['rememberme']);
        } catch (\Exception $e) {
            // only let unsuccessful logins count toward the throttling limit
            $throttler->logEvent('sign_in_attempt', $throttleData);

            throw $e;
        }

        $ms->addMessageTranslated('success', 'WELCOME', $currentUser->toArray());

        // Set redirect, if relevant
        $redirectOnLogin = $this->ci->get('redirect.onLogin');

        return $redirectOnLogin($request, $response, $args);
    }

    /**
     * Log the user out completely, including destroying any "remember me" token.
     *
     * AuthGuard: true
     * Route: /account/logout
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function logout(Request $request, Response $response, $args)
    {
        // Destroy the session
        $this->ci->authenticator->logout();

        // Return to home page
        $config = $this->ci->config;

        return $response->withStatus(302)->withHeader('Location', $config['site.uri.public']);
    }

    /**
     * Processes an new account registration request.
     *
     * This is throttled to prevent account enumeration, since it needs to divulge when a username/email has been used.
     * Processes the request from the form on the registration page, checking that:
     * 1. The honeypot was not modified;
     * 2. The master account has already been created (during installation);
     * 3. Account registration is enabled;
     * 4. The user is not already logged in;
     * 5. Valid information was entered;
     * 6. The captcha, if enabled, is correct;
     * 7. The username and email are not already taken.
     * Automatically sends an activation link upon success, if account activation is enabled.
     * This route is "public access".
     * Returns the User Object for the user record that was created.
     *
     * AuthGuard: false
     * Route: /account/register
     * Route Name: {none}
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @throws SpammyRequestException
     */
    public function register(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Get POST parameters: user_name, first_name, last_name, email, password, passwordc, captcha, spiderbro, csrf_token
        $params = $request->getParsedBody();

        // Check the honeypot. 'spiderbro' is not a real field, it is hidden on the main page and must be submitted with its default value for this to be processed.
        if (!isset($params['spiderbro']) || $params['spiderbro'] != 'http://') {
            throw new SpammyRequestException('Possible spam received:' . print_r($params, true));
        }

        // Security measure: do not allow registering new users until the master account has been created.
        if (!$classMapper->getClassMapping('user')::findInt($config['reserved_user_ids.master'])) {
            $ms->addMessageTranslated('danger', 'ACCOUNT.MASTER_NOT_EXISTS');

            return $response->withJson([], 403);
        }

        // Check if registration is currently enabled
        if (!$config['site.registration.enabled']) {
            $ms->addMessageTranslated('danger', 'REGISTRATION.DISABLED');

            return $response->withJson([], 403);
        }

        /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
        $authenticator = $this->ci->authenticator;

        // Prevent the user from registering if he/she is already logged in
        if ($authenticator->check()) {
            $ms->addMessageTranslated('danger', 'REGISTRATION.LOGOUT');

            return $response->withJson([], 403);
        }

        // Load the request schema
        $schema = new RequestSchema('schema://requests/register.yaml');
        $schema->set('password.validators.length.min', $config['site.password.length.min']);
        $schema->set('password.validators.length.max', $config['site.password.length.max']);
        $schema->set('passwordc.validators.length.min', $config['site.password.length.min']);
        $schema->set('passwordc.validators.length.max', $config['site.password.length.max']);

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        $error = false;

        // Ensure that in the case of using a single locale, that the locale is set
        if (count($this->ci->locale->getAvailableIdentifiers()) <= 1) {
            $data['locale'] = $config['site.registration.user_defaults.locale'];
        }

        // Validate request data
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);
            $error = true;
        }

        /** @var \UserFrosting\Sprinkle\Core\Throttle\Throttler $throttler */
        $throttler = $this->ci->throttler;
        $delay = $throttler->getDelay('registration_attempt');

        // Throttle requests
        if ($delay > 0) {
            return $response->withJson([], 429);
        }

        // Check captcha, if required
        if ($config['site.registration.captcha']) {
            $captcha = new Captcha($this->ci->session, $this->ci->config['session.keys.captcha']);
            if (!isset($data['captcha']) || !$captcha->verifyCode($data['captcha'])) {
                $ms->addMessageTranslated('danger', 'CAPTCHA.FAIL');
                $error = true;
            }
        }

        if ($error) {
            return $response->withJson([], 400);
        }

        // Remove captcha, password confirmation from object data after validation
        unset($data['captcha']);
        unset($data['passwordc']);

        // Now that we check the form, we can register the actual user
        $registration = new Registration($this->ci, $data);

        // Try registration. An HttpException will be thrown if it fails
        // No need to catch, as this kind of exception will automatically returns the addMessageTranslated
        $user = $registration->register();

        // Success message
        if ($config['site.registration.require_email_verification']) {
            // Verification required
            $ms->addMessageTranslated('success', 'REGISTRATION.COMPLETE_TYPE2', $user->toArray());
        } else {
            // No verification required
            $ms->addMessageTranslated('success', 'REGISTRATION.COMPLETE_TYPE1');
        }

        return $response->withJson([], 200);
    }
}
