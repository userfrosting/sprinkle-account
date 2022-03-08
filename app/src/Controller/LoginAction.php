<?php

declare(strict_types=1);

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
use UserFrosting\Alert\AlertStream;
use UserFrosting\Config\Config;
use UserFrosting\Event\EventDispatcher;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\RequestSchema\RequestSchemaInterface;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\I18n\Translator;
use UserFrosting\Sprinkle\Account\Authenticate\Authenticator;
use UserFrosting\Sprinkle\Account\Event\UserRedirectedAfterLoginEvent;
use UserFrosting\Sprinkle\Account\Exceptions\AccountException;
use UserFrosting\Sprinkle\Account\Exceptions\InvalidCredentialsException;
use UserFrosting\Sprinkle\Core\Exceptions\ValidationException;
use UserFrosting\Sprinkle\Core\Throttle\Throttler;
use UserFrosting\Sprinkle\Core\Throttle\ThrottlerDelayException;

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
 * Middleware: GuestGuard
 * Route: /account/login
 * Route Name: account.login
 * Request type: POST
 */
class LoginAction
{
    // Request schema to use to validate data.
    protected string $schema = 'schema://requests/login.yaml';

    /**
     * Inject dependencies.
     */
    public function __construct(
        protected Authenticator $authenticator,
        protected AlertStream $alert,
        protected Config $config,
        protected Translator $translator,
        protected Throttler $throttler,
        protected EventDispatcher $eventDispatcher,
    ) {
    }

    /**
     * Receive the request, dispatch to the handler, and return the payload to
     * the response.
     *
     * @param Request  $request
     * @param Response $response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $this->handle($request);

        // Get redirect target and add Header
        $event = $this->eventDispatcher->dispatch(new UserRedirectedAfterLoginEvent());
        if ($event->getRedirect() !== null) {
            $response = $response->withHeader('UF-Redirect', $event->getRedirect());
        }

        // Write empty response
        $payload = json_encode([], JSON_THROW_ON_ERROR);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Handle the request and return the payload.
     *
     * @param Request $request
     */
    protected function handle(Request $request): void
    {
        // Get POST parameters
        $params = (array) $request->getParsedBody();

        // Load the request schema
        $schema = $this->getSchema();

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate request data, and halt on validation errors.
        // Failed validation attempts do not count towards throttling limit.
        $this->validateData($schema, $data);

        // Determine whether we are trying to log in with an email address or a username
        $userIdentifier = $data['user_name'];
        $isEmail = filter_var($userIdentifier, FILTER_VALIDATE_EMAIL);

        // Throttle requests.
        $this->throttle($userIdentifier);

        // If credential is an email address, but email login is not enabled, raise an error.
        // Note that this error counts towards the throttling limit.
        if ($isEmail == true && !boolval($this->config->get('site.login.enable_email'))) {
            $this->throttler->logEvent('sign_in_attempt', [
                'user_identifier' => $userIdentifier,
            ]);

            // Throw exception
            throw new InvalidCredentialsException();
        }

        // Try to authenticate the user.  Authenticator will throw an exception on failure.
        try {
            $currentUser = $this->authenticator->attempt(($isEmail == true ? 'email' : 'user_name'), $userIdentifier, $data['password'], $data['rememberme']);
        } catch (AccountException $e) {
            // only let unsuccessful logins count toward the throttling limit
            $this->throttler->logEvent('sign_in_attempt', [
                'user_identifier' => $userIdentifier,
            ]);

            // Rethrow as InvalidCredentialsException not give away the actual
            // exception to the end user for security.
            throw new InvalidCredentialsException();
        }

        // Add success message
        $this->alert->addMessageTranslated('success', 'WELCOME', $currentUser->toArray());
    }

    /**
     * Load the request schema.
     *
     * @return RequestSchemaInterface
     */
    protected function getSchema(): RequestSchemaInterface
    {
        return new RequestSchema($this->schema);
    }

    /**
     * Validate request POST data.
     *
     * @param RequestSchemaInterface $schema
     * @param mixed[]                $data
     */
    protected function validateData(RequestSchemaInterface $schema, array $data): void
    {
        $validator = new ServerSideValidator($schema, $this->translator);
        if ($validator->validate($data) === false && is_array($validator->errors())) {
            $e = new ValidationException();
            $e->addErrors($validator->errors());

            throw $e;
        }
    }

    /**
     * Throttle requests.
     */
    protected function throttle(string $userIdentifier): void
    {
        $delay = $this->throttler->getDelay('sign_in_attempt', [
            'user_identifier' => $userIdentifier,
        ]);
        if ($delay > 0) {
            $e = new ThrottlerDelayException();
            $e->setDelay($delay);

            throw $e;
        }
    }
}
