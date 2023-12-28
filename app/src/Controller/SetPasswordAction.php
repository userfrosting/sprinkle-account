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
use Slim\Interfaces\RouteParserInterface;
use UserFrosting\Alert\AlertStream;
use UserFrosting\Config\Config;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\RequestSchema\RequestSchemaInterface;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\I18n\Translator;
use UserFrosting\Sprinkle\Account\Exceptions\PasswordResetInvalidException;
use UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository;
use UserFrosting\Sprinkle\Core\Exceptions\ValidationException;

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
 * Middleware: GuestGuard
 * Route: /account/set-password
 * Route Name: account.setPassword
 * Request type: POST
 */
class SetPasswordAction
{
    // Request schema to use to validate data.
    protected string $schema = 'schema://requests/set-password.yaml';

    /**
     * Inject dependencies.
     */
    public function __construct(
        protected AlertStream $alert,
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

        return $response;
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

        // Validate request data
        $this->validateData($schema, $data);

        // Ok, try to complete the request with the specified token and new password
        $passwordReset = $this->repoPasswordReset->complete($data['token'], [
            'password' => $data['password'],
        ]);

        if ($passwordReset === false) {
            throw new PasswordResetInvalidException();
        }

        $this->alert->addMessage('success', 'PASSWORD.UPDATED');
    }

    /**
     * Load the request schema.
     *
     * @return RequestSchemaInterface
     */
    protected function getSchema(): RequestSchemaInterface
    {
        $schema = new RequestSchema($this->schema);
        $schema->set('password.validators.length.min', $this->config->get('site.password.length.min'));
        $schema->set('password.validators.length.max', $this->config->get('site.password.length.max'));
        $schema->set('passwordc.validators.length.min', $this->config->get('site.password.length.min'));
        $schema->set('passwordc.validators.length.max', $this->config->get('site.password.length.max'));

        return $schema;
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
}
