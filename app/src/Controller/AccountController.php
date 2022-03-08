<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Controller;

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use UserFrosting\Fortress\Adapter\JqueryValidationAdapter;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\Sprinkle\Account\Account\Registration;
use UserFrosting\Sprinkle\Account\Facades\Password;
use UserFrosting\Sprinkle\Account\Util\Util as AccountUtil;
use UserFrosting\Sprinkle\Core\Controller\SimpleController;
use UserFrosting\Sprinkle\Core\Mail\EmailRecipient;
use UserFrosting\Sprinkle\Core\Mail\TwigMailMessage;
use UserFrosting\Support\Exception\BadRequestException;
use UserFrosting\Support\Exception\ForbiddenException;

/**
 * Controller class for /account/* URLs.  Handles account-related activities, including login, registration, password recovery, and account settings.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 *
 * @see http://www.userfrosting.com/navigating/#structure
 */
class AccountController extends SimpleController
{
    /**
     * Check a username for availability.
     *
     * This route is throttled by default, to discourage abusing it for account enumeration.
     * This route is "public access".
     *
     * AuthGuard: false
     * Route: /account/check-username
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @throws BadRequestException
     */
    public function checkUsername(Request $request, Response $response, $args)
    {
        // GET parameters
        $params = $request->getQueryParams();

        // Load request schema
        $schema = new RequestSchema('schema://requests/check-username.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            // TODO: encapsulate the communication of error messages from ServerSideValidator to the BadRequestException
            $e = new BadRequestException('Missing or malformed request data!');
            foreach ($validator->errors() as $idx => $field) {
                foreach ($field as $eidx => $error) {
                    $e->addUserMessage($error);
                }
            }

            throw $e;
        }

        /** @var \UserFrosting\Sprinkle\Core\Throttle\Throttler $throttler */
        $throttler = $this->ci->throttler;
        $delay = $throttler->getDelay('check_username_request');

        // Throttle requests
        if ($delay > 0) {
            return $response->withJson([], 429);
        }

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\I18n\Translator $translator */
        $translator = $this->ci->translator;

        // Log throttleable event
        $throttler->logEvent('check_username_request');

        if ($classMapper->getClassMapping('user')::findUnique($data['user_name'], 'user_name')) {
            $message = $translator->translate('USERNAME.NOT_AVAILABLE', $data);

            return $response->write($message)->withStatus(200);
        } else {
            return $response->write('true')->withStatus(200);
        }
    }

    /**
     * Processes a request to cancel a password reset request.
     *
     * This is provided so that users can cancel a password reset request, if they made it in error or if it was not initiated by themselves.
     * Processes the request from the password reset link, checking that:
     * 1. The provided token is associated with an existing user account, who has a pending password reset request.
     *
     * AuthGuard: false
     * Route: /account/set-password/deny
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function denyResetPassword(Request $request, Response $response, $args)
    {
        // GET parameters
        $params = $request->getQueryParams();

        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        $loginPage = $this->ci->router->pathFor('login');

        // Load validation rules
        $schema = new RequestSchema('schema://requests/deny-password.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.  Since this is a GET request, we need to redirect on failure
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);

            return $response->withRedirect($loginPage);
        }

        /** @var \UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository $passwordReset */
        $passwordReset = $this->ci->repoPasswordReset->cancel($data['token']);

        if (!$passwordReset) {
            $ms->addMessageTranslated('danger', 'PASSWORD.FORGET.INVALID');

            return $response->withRedirect($loginPage);
        }

        $ms->addMessageTranslated('success', 'PASSWORD.FORGET.REQUEST_CANNED');

        return $response->withRedirect($loginPage);
    }

    /**
     * Processes a request to email a forgotten password reset link to the user.
     *
     * Processes the request from the form on the "forgot password" page, checking that:
     * 1. The rate limit for this type of request is being observed.
     * 2. The provided email address belongs to a registered account;
     * 3. The submitted data is valid.
     * Note that we have removed the requirement that a password reset request not already be in progress.
     * This is because we need to allow users to re-request a reset, even if they lose the first reset email.
     * This route is "public access".
     *
     * @todo require additional user information
     * @todo prevent password reset requests for root account?
     *
     * AuthGuard: false
     * Route: /account/forgot-password
     * Route Name: {none}
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function forgotPassword(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Get POST parameters
        $params = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema('schema://requests/forgot-password.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.  Failed validation attempts do not count towards throttling limit.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);

            return $response->withJson([], 400);
        }

        // Throttle requests
        /** @var \UserFrosting\Sprinkle\Core\Throttle\Throttler $throttler */
        $throttler = $this->ci->throttler;

        $throttleData = [
            'email' => $data['email'],
        ];
        $delay = $throttler->getDelay('password_reset_request', $throttleData);

        if ($delay > 0) {
            $ms->addMessageTranslated('danger', 'RATE_LIMIT_EXCEEDED', ['delay' => $delay]);

            return $response->withJson([], 429);
        }

        // All checks passed!  log events/activities, update user, and send email
        // Begin transaction - DB will be rolled back if an exception occurs
        Capsule::transaction(function () use ($classMapper, $data, $throttler, $throttleData, $config) {

            // Log throttleable event
            $throttler->logEvent('password_reset_request', $throttleData);

            // Load the user, by email address
            $user = $classMapper->getClassMapping('user')::where('email', $data['email'])->first();

            // Check that the email exists.
            // If there is no user with that email address, we should still pretend like we succeeded, to prevent account enumeration
            if ($user) {
                // Try to generate a new password reset request.
                // Use timeout for "reset password"
                $passwordReset = $this->ci->repoPasswordReset->create($user, $config['password_reset.timeouts.reset']);

                // Create and send email
                $message = new TwigMailMessage($this->ci->view, 'mail/password-reset.html.twig');
                $message->from($config['address_book.admin'])
                        ->addEmailRecipient(new EmailRecipient($user->email, $user->full_name))
                        ->addParams([
                            'user'         => $user,
                            'token'        => $passwordReset->getToken(),
                            'request_date' => Carbon::now()->format('Y-m-d H:i:s'),
                        ]);

                $this->ci->mailer->send($message);
            }
        });

        // TODO: create delay to prevent timing-based attacks

        $ms->addMessageTranslated('success', 'PASSWORD.FORGET.REQUEST_SENT', ['email' => $data['email']]);

        return $response->withJson([], 200);
    }

    /**
     * Returns a modal containing account terms of service.
     *
     * This does NOT render a complete page.  Instead, it renders the HTML for the form, which can be embedded in other pages.
     *
     * AuthGuard: false
     * Route: /modals/account/tos
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    // TODO : Move to Theme repo
    public function getModalAccountTos(Request $request, Response $response, $args)
    {
        return $this->ci->view->render($response, 'modals/tos.html.twig');
    }

    /**
     * Render the "forgot password" page.
     *
     * This creates a simple form to allow users who forgot their password to have a time-limited password reset link emailed to them.
     * By default, this is a "public page" (does not require authentication).
     *
     * AuthGuard: false
     * Route: /account/forgot-password
     * Route Name: forgot-password
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    // TODO : Move to Theme repo ?
    public function pageForgotPassword(Request $request, Response $response, $args)
    {
        // Load validation rules
        $schema = new RequestSchema('schema://requests/forgot-password.yaml');
        $validator = new JqueryValidationAdapter($schema, $this->ci->translator);

        return $this->ci->view->render($response, 'pages/forgot-password.html.twig', [
            'page' => [
                'validators' => [
                    'forgot_password'    => $validator->rules('json', false),
                ],
            ],
        ]);
    }

    /**
     * Render the "resend verification email" page.
     *
     * This is a form that allows users who lost their account verification link to have the link resent to their email address.
     * By default, this is a "public page" (does not require authentication).
     *
     * AuthGuard: false
     * Route: /account/resend-verification
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    // TODO : Move to Theme repo ?
    public function pageResendVerification(Request $request, Response $response, $args)
    {
        // Load validation rules
        $schema = new RequestSchema('schema://requests/resend-verification.yaml');
        $validator = new JqueryValidationAdapter($schema, $this->ci->translator);

        return $this->ci->view->render($response, 'pages/resend-verification.html.twig', [
            'page' => [
                'validators' => [
                    'resend_verification'    => $validator->rules('json', false),
                ],
            ],
        ]);
    }

    /**
     * Reset password page.
     *
     * Renders the new password page for password reset requests.
     *
     * AuthGuard: false
     * Route: /account/set-password/confirm
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    // TODO : Move to Theme repo ?
    public function pageResetPassword(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Insert the user's secret token from the link into the password reset form
        $params = $request->getQueryParams();

        // Load validation rules - note this uses the same schema as "set password"
        $schema = new RequestSchema('schema://requests/set-password.yaml');
        $schema->set('password.validators.length.min', $config['site.password.length.min']);
        $schema->set('password.validators.length.max', $config['site.password.length.max']);
        $schema->set('passwordc.validators.length.min', $config['site.password.length.min']);
        $schema->set('passwordc.validators.length.max', $config['site.password.length.max']);
        $validator = new JqueryValidationAdapter($schema, $this->ci->translator);

        return $this->ci->view->render($response, 'pages/reset-password.html.twig', [
            'page' => [
                'validators' => [
                    'set_password'    => $validator->rules('json', false),
                ],
            ],
            'token' => isset($params['token']) ? $params['token'] : '',
        ]);
    }

    /**
     * Render the "set password" page.
     *
     * Renders the page where new users who have had accounts created for them by another user, can set their password.
     * By default, this is a "public page" (does not require authentication).
     *
     * AuthGuard: false
     * Route:
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    // TODO : Move to Theme repo ?
    public function pageSetPassword(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Insert the user's secret token from the link into the password set form
        $params = $request->getQueryParams();

        // Load validation rules
        $schema = new RequestSchema('schema://requests/set-password.yaml');
        $schema->set('password.validators.length.min', $config['site.password.length.min']);
        $schema->set('password.validators.length.max', $config['site.password.length.max']);
        $schema->set('passwordc.validators.length.min', $config['site.password.length.min']);
        $schema->set('passwordc.validators.length.max', $config['site.password.length.max']);
        $validator = new JqueryValidationAdapter($schema, $this->ci->translator);

        return $this->ci->view->render($response, 'pages/set-password.html.twig', [
            'page' => [
                'validators' => [
                    'set_password'    => $validator->rules('json', false),
                ],
            ],
            'token' => isset($params['token']) ? $params['token'] : '',
        ]);
    }

    /**
     * Account settings page.
     *
     * Provides a form for users to modify various properties of their account, such as name, email, locale, etc.
     * Any fields that the user does not have permission to modify will be automatically disabled.
     * This page requires authentication.
     *
     * AuthGuard: true
     * Route: /account/settings
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @throws ForbiddenException If user is not authorized to access page
     */
    // TODO : Move to Theme repo ?
    public function pageSettings(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        /** @var \UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager */
        $authorizer = $this->ci->authorizer;

        /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface $currentUser */
        $currentUser = $this->ci->currentUser;

        // Access-controlled page
        if (!$authorizer->checkAccess($currentUser, 'uri_account_settings')) {
            throw new ForbiddenException();
        }

        // Load validation rules
        $schema = new RequestSchema('schema://requests/account-settings.yaml');
        $schema->set('password.validators.length.min', $config['site.password.length.min']);
        $schema->set('password.validators.length.max', $config['site.password.length.max']);
        $schema->set('passwordc.validators.length.min', $config['site.password.length.min']);
        $schema->set('passwordc.validators.length.max', $config['site.password.length.max']);
        $validatorAccountSettings = new JqueryValidationAdapter($schema, $this->ci->translator);

        $schema = new RequestSchema('schema://requests/profile-settings.yaml');
        $validatorProfileSettings = new JqueryValidationAdapter($schema, $this->ci->translator);

        // Get a list of all locales
        $locales = $this->ci->locale->getAvailableOptions();

        // Hide the locale field if there is only 1 locale available
        $fields = [
            'hidden'   => [],
            'disabled' => [],
        ];
        if (count($locales) <= 1) {
            $fields['hidden'][] = 'locale';
        }

        return $this->ci->view->render($response, 'pages/account-settings.html.twig', [
            'locales' => $locales,
            'fields'  => $fields,
            'page'    => [
                'validators' => [
                    'account_settings'    => $validatorAccountSettings->rules('json', false),
                    'profile_settings'    => $validatorProfileSettings->rules('json', false),
                ],
                'visibility' => ($authorizer->checkAccess($currentUser, 'update_account_settings') ? '' : 'disabled'),
            ],
        ]);
    }

    /**
     * Processes a request to update a user's profile information.
     *
     * Processes the request from the user profile settings form, checking that:
     * 1. They have the necessary permissions to update the posted field(s);
     * 2. The submitted data is valid.
     * This route requires authentication.
     *
     * AuthGuard: true
     * Route: /account/settings/profile
     * Route Name: {none}
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function profile(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager */
        $authorizer = $this->ci->authorizer;

        /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface $currentUser */
        $currentUser = $this->ci->currentUser;

        // Access control for entire resource - check that the current user has permission to modify themselves
        // See recipe "per-field access control" for dynamic fine-grained control over which properties a user can modify.
        if (!$authorizer->checkAccess($currentUser, 'update_account_settings')) {
            $ms->addMessageTranslated('danger', 'ACCOUNT.ACCESS_DENIED');

            return $response->withJson([], 403);
        }

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // POST parameters
        $params = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema('schema://requests/profile-settings.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        $error = false;

        // Get locales
        $locales = $this->ci->locale->getAvailableIdentifiers();

        // Ensure that in the case of using a single locale, that the locale is set
        if (count($locales) <= 1) {
            $data['locale'] = $currentUser->locale;
        }

        // Validate, and halt on validation errors.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);
            $error = true;
        }

        // Check that locale is valid
        if (isset($data['locale']) && !in_array($data['locale'], $locales)) {
            $ms->addMessageTranslated('danger', 'LOCALE.INVALID', $data);
            $error = true;
        }

        if ($error) {
            return $response->withJson([], 400);
        }

        // Looks good, let's update with new values!
        // Note that only fields listed in `profile-settings.yaml` will be permitted in $data, so this prevents the user from updating all columns in the DB
        $currentUser->fill($data);

        $currentUser->save();

        // Create activity record
        $this->ci->userActivityLogger->info("User {$currentUser->user_name} updated their profile settings.", [
            'type' => 'update_profile_settings',
        ]);

        $ms->addMessageTranslated('success', 'PROFILE.UPDATED');

        return $response->withJson([], 200);
    }

    /**
     * Processes a request to resend the verification email for a new user account.
     *
     * Processes the request from the resend verification email form, checking that:
     * 1. The rate limit on this type of request is observed;
     * 2. The provided email is associated with an existing user account;
     * 3. The user account is not already verified;
     * 4. The submitted data is valid.
     * This route is "public access".
     *
     * AuthGuard: false
     * Route: /account/resend-verification
     * Route Name: {none}
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function resendVerification(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Get POST parameters
        $params = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema('schema://requests/resend-verification.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.  Failed validation attempts do not count towards throttling limit.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);

            return $response->withJson([], 400);
        }

        // Throttle requests

        /** @var \UserFrosting\Sprinkle\Core\Throttle\Throttler $throttler */
        $throttler = $this->ci->throttler;

        $throttleData = [
            'email' => $data['email'],
        ];
        $delay = $throttler->getDelay('verification_request', $throttleData);

        if ($delay > 0) {
            $ms->addMessageTranslated('danger', 'RATE_LIMIT_EXCEEDED', ['delay' => $delay]);

            return $response->withJson([], 429);
        }

        // All checks passed!  log events/activities, create user, and send verification email (if required)
        // Begin transaction - DB will be rolled back if an exception occurs
        Capsule::transaction(function () use ($classMapper, $data, $throttler, $throttleData, $config) {
            // Log throttleable event
            $throttler->logEvent('verification_request', $throttleData);

            // Load the user, by email address
            $user = $classMapper->getClassMapping('user')::where('email', $data['email'])->first();

            // Check that the user exists and is not already verified.
            // If there is no user with that email address, or the user exists and is already verified,
            // we pretend like we succeeded to prevent account enumeration
            if ($user && $user->flag_verified != '1') {
                // We're good to go - record user activity and send the email
                $verification = $this->ci->repoVerification->create($user, $config['verification.timeout']);

                // Create and send verification email
                $message = new TwigMailMessage($this->ci->view, 'mail/resend-verification.html.twig');

                $message->from($config['address_book.admin'])
                        ->addEmailRecipient(new EmailRecipient($user->email, $user->full_name))
                        ->addParams([
                            'user'  => $user,
                            'token' => $verification->getToken(),
                        ]);

                $this->ci->mailer->send($message);
            }
        });

        $ms->addMessageTranslated('success', 'ACCOUNT.VERIFICATION.NEW_LINK_SENT', ['email' => $data['email']]);

        return $response->withJson([], 200);
    }

    /**
     * Processes a request to set the password for a new or current user.
     *
     * Processes the request from the password create/reset form, which should have the secret token embedded in it, checking that:
     * 1. The provided secret token is associated with an existing user account;
     * 2. The user has a password set/reset request in progress;
     * 3. The token has not expired;
     * 4. The submitted data (new password) is valid.
     * This route is "public access".
     *
     * AuthGuard: false
     * Route: /account/set-password
     * Route Name: {none}
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function setPassword(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // Get POST parameters
        $params = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema('schema://requests/set-password.yaml');
        $schema->set('password.validators.length.min', $config['site.password.length.min']);
        $schema->set('password.validators.length.max', $config['site.password.length.max']);
        $schema->set('passwordc.validators.length.min', $config['site.password.length.min']);
        $schema->set('passwordc.validators.length.max', $config['site.password.length.max']);

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.  Failed validation attempts do not count towards throttling limit.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);

            return $response->withJson([], 400);
        }

        $forgotPasswordPage = $this->ci->router->pathFor('forgot-password');

        // Ok, try to complete the request with the specified token and new password
        $passwordReset = $this->ci->repoPasswordReset->complete($data['token'], [
            'password' => $data['password'],
        ]);

        if (!$passwordReset) {
            $ms->addMessageTranslated('danger', 'PASSWORD.FORGET.INVALID', ['url' => $forgotPasswordPage]);

            return $response->withJson([], 400);
        }

        $ms->addMessageTranslated('success', 'PASSWORD.UPDATED');

        // TODO : Token won't return the model. The user should bee sent to the login pag, not autologin.

        /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
        // $authenticator = $this->ci->authenticator;

        // Log out any existing user, and create a new session
        // if ($authenticator->check()) {
        //     $authenticator->logout();
        // }

        // Auto-login the user (without "remember me")
        // $user = $passwordReset->user;
        // $authenticator->login($user);

        // $ms->addMessageTranslated('success', 'WELCOME', $user->toArray());

        return $response->withJson([], 200);
    }

    /**
     * Processes a request to update a user's account information.
     *
     * Processes the request from the user account settings form, checking that:
     * 1. The user correctly input their current password;
     * 2. They have the necessary permissions to update the posted field(s);
     * 3. The submitted data is valid.
     * This route requires authentication.
     *
     * AuthGuard: true
     * Route: /account/settings
     * Route Name: settings
     * Request type: POST
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function settings(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager */
        $authorizer = $this->ci->authorizer;

        /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface $currentUser */
        $currentUser = $this->ci->currentUser;

        // Access control for entire resource - check that the current user has permission to modify themselves
        // See recipe "per-field access control" for dynamic fine-grained control over which properties a user can modify.
        if (!$authorizer->checkAccess($currentUser, 'update_account_settings')) {
            $ms->addMessageTranslated('danger', 'ACCOUNT.ACCESS_DENIED');

            return $response->withJson([], 403);
        }

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        // POST parameters
        $params = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema('schema://requests/account-settings.yaml');
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
            $data['locale'] = $currentUser->locale;
        }

        // Validate, and halt on validation errors.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);
            $error = true;
        }

        // Confirm current password
        if (!isset($data['passwordcheck']) || !Password::verify($data['passwordcheck'], $currentUser->password)) {
            $ms->addMessageTranslated('danger', 'PASSWORD.INVALID');
            $error = true;
        }

        // Remove password check, password confirmation from object data after validation
        unset($data['passwordcheck']);
        unset($data['passwordc']);

        // If new email was submitted, check that the email address is not in use
        if (isset($data['email']) && $data['email'] != $currentUser->email && $classMapper->getClassMapping('user')::findUnique($data['email'], 'email')) {
            $ms->addMessageTranslated('danger', 'EMAIL.IN_USE', $data);
            $error = true;
        }

        if ($error) {
            return $response->withJson([], 400);
        }

        // Hash new password, if specified
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Password::hash($data['password']);
        } else {
            // Do not pass to model if no password is specified
            unset($data['password']);
        }

        // Looks good, let's update with new values!
        // Note that only fields listed in `account-settings.yaml` will be permitted in $data, so this prevents the user from updating all columns in the DB
        $currentUser->fill($data);

        $currentUser->save();

        // Create activity record
        $this->ci->userActivityLogger->info("User {$currentUser->user_name} updated their account settings.", [
            'type' => 'update_account_settings',
        ]);

        $ms->addMessageTranslated('success', 'ACCOUNT.SETTINGS.UPDATED');

        return $response->withJson([], 200);
    }

    /**
     * Suggest an available username for a specified first/last name.
     *
     * This route is "public access".
     *
     * @todo Can this route be abused for account enumeration?  If so we should throttle it as well.
     *
     * AuthGuard: false
     * Route: /account/suggest-username
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function suggestUsername(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        $suggestion = AccountUtil::randomUniqueUsername($classMapper, 50, 10);

        // Be careful how you consume this data - it has not been escaped and contains untrusted user-supplied content.
        // For example, if you plan to insert it into an HTML DOM, you must escape it on the client side (or use client-side templating).
        return $response->withJson([
            'user_name' => $suggestion,
        ], 200, JSON_PRETTY_PRINT);
    }

    /**
     * Processes an new email verification request.
     *
     * Processes the request from the email verification link that was emailed to the user, checking that:
     * 1. The token provided matches a user in the database;
     * 2. The user account is not already verified;
     * This route is "public access".
     *
     * AuthGuard: false
     * Route: /account/verify
     * Route Name: {none}
     * Request type: GET
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     */
    public function verify(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
        $ms = $this->ci->alerts;

        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = $this->ci->classMapper;

        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = $this->ci->config;

        $loginPage = $this->ci->router->pathFor('login');

        // GET parameters
        $params = $request->getQueryParams();

        // Load request schema
        $schema = new RequestSchema('schema://requests/account-verify.yaml');

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate, and halt on validation errors.  This is a GET request, so we redirect on validation error.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);

            return $response->withRedirect($loginPage);
        }

        $verification = $this->ci->repoVerification->complete($data['token']);

        if (!$verification) {
            $ms->addMessageTranslated('danger', 'ACCOUNT.VERIFICATION.TOKEN_NOT_FOUND');

            return $response->withRedirect($loginPage);
        }

        $ms->addMessageTranslated('success', 'ACCOUNT.VERIFICATION.COMPLETE');

        // Forward to login page
        return $response->withRedirect($loginPage);
    }
}
