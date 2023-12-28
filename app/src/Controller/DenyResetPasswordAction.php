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

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteParserInterface;
use UserFrosting\Alert\AlertStream;
use UserFrosting\Config\Config;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\RequestSchema\RequestSchemaInterface;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\I18n\Translator;
use UserFrosting\Sprinkle\Account\Event\UserRedirectedAfterDenyResetPasswordEvent;
use UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository;

/**
 * Processes a request to cancel a password reset request.
 *
 * This is provided so that users can cancel a password reset request, if they made it in error or if it was not initiated by themselves.
 * Processes the request from the password reset link, checking that:
 * 1. The provided token is associated with an existing user account, who has a pending password reset request.
 *
 * Middleware: GuestGuard
 * Route: /account/set-password/deny
 * Route Name: account.setPassword.deny
 * Request type: GET
 */
class DenyResetPasswordAction
{
    // Request schema to use to validate data.
    protected string $schema = 'schema://requests/deny-password.yaml';

    /**
     * Inject dependencies.
     *
     * @param \UserFrosting\Event\EventDispatcher $eventDispatcher
     */
    public function __construct(
        protected AlertStream $alert,
        protected EventDispatcherInterface $eventDispatcher,
        protected Config $config,
        protected RouteParserInterface $routeParser,
        protected Translator $translator,
        protected PasswordResetRepository $repoPasswordReset,
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
        $event = $this->eventDispatcher->dispatch(new UserRedirectedAfterDenyResetPasswordEvent());
        if ($event->getRedirect() !== null) {
            return $response
                ->withHeader('Location', $event->getRedirect())
                ->withStatus(302);
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
        // Get GET parameters
        $params = $request->getQueryParams();

        // Load the request schema
        $schema = $this->getSchema();

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Validate request data
        $validator = new ServerSideValidator($schema, $this->translator);
        if ($validator->validate($data) === false && is_array($validator->errors())) {
            $this->alert->addValidationErrors($validator);

            return;
        }

        // Cancel repository
        $passwordReset = $this->repoPasswordReset->cancel($data['token']);
        if ($passwordReset === false) {
            $this->alert->addMessage('danger', 'ACCOUNT.EXCEPTION.PASSWORD_RESET.TITLE');

            return;
        }

        $this->alert->addMessage('success', 'PASSWORD.FORGET.REQUEST_CANNED');
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
}
