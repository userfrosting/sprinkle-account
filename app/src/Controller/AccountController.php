<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use UserFrosting\Fortress\Adapter\JqueryValidationAdapter;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\Sprinkle\Account\Account\Registration;
use UserFrosting\Sprinkle\Account\Facades\Password;
use UserFrosting\Sprinkle\Core\Controller\SimpleController;
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
    /*public function getModalAccountTos(Request $request, Response $response, $args)
    {
        return $this->ci->view->render($response, 'modals/tos.html.twig');
    }*/

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
    /*public function pageForgotPassword(Request $request, Response $response, $args)
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
    }*/

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
    /*public function pageResendVerification(Request $request, Response $response, $args)
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
    }*/

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
    /*public function pageResetPassword(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Support\Repository\Repository $config * /
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
    }*/

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
    /*public function pageSetPassword(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Support\Repository\Repository $config * /
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
    }*/

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
    /*public function pageSettings(Request $request, Response $response, $args)
    {
        /** @var \UserFrosting\Support\Repository\Repository $config * /
        $config = $this->ci->config;

        /** @var \UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager * /
        $authorizer = $this->ci->authorizer;

        /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface $currentUser * /
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
    }*/

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
}
