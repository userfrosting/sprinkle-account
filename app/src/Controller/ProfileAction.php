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
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\RequestSchema\RequestSchemaInterface;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\I18n\Translator;
use UserFrosting\Sprinkle\Account\Authenticate\Authenticator;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Exceptions\LocaleNotFoundException;
use UserFrosting\Sprinkle\Account\Log\UserActivityLogger;
use UserFrosting\Sprinkle\Core\Exceptions\ValidationException;
use UserFrosting\Sprinkle\Core\I18n\SiteLocale;

/**
 * Processes a request to update a user's profile information.
 *
 * Processes the request from the user profile settings form, checking that:
 * 1. They have the necessary permissions to update the posted field(s);
 * 2. The submitted data is valid.
 * This route requires authentication.
 *
 * Middleware: AuthGuard
 * Route: /account/settings/profile
 * Route Name: settings.profile
 * Request type: POST
 */
class ProfileAction
{
    // Request schema to use to validate data.
    protected string $schema = 'schema://requests/profile-settings.yaml';

    /**
     * Inject dependencies.
     */
    public function __construct(
        protected AlertStream $alert,
        protected Authenticator $authenticator,
        protected SiteLocale $locale,
        protected Translator $translator,
        protected UserActivityLogger $logger,
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
        // Access control for entire resource - check that the current user has permission to modify themselves
        // See recipe "per-field access control" for dynamic fine-grained control over which properties a user can modify.
        // TODO
        // if (!$authorizer->checkAccess($currentUser, 'update_account_settings')) {
        //     $ms->addMessageTranslated('danger', 'ACCOUNT.ACCESS_DENIED');

        //     return $response->withJson([], 403);
        // }

        // Get POST parameters
        $params = (array) $request->getParsedBody();

        // Load the request schema
        $schema = $this->getSchema();

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        // Get current user. Won't be null, as AuthGuard prevent it
        /** @var UserInterface */
        $currentUser = $this->authenticator->user();

        // Ensure that in the case of using a single locale, that the locale is set
        $locales = $this->locale->getAvailableIdentifiers();
        if (count($locales) <= 1) {
            $data['locale'] = $currentUser->locale;
        }

        // Validate request data
        $this->validateData($schema, $data);

        // Check that locale is valid. Required is done in schema.
        if (!in_array($data['locale'], $locales, true)) {
            $e = new LocaleNotFoundException();
            $e->setLocale($data['locale']);

            throw $e;
        }

        // Looks good, let's update with new values!
        // Note that only fields listed in `profile-settings.yaml` will be
        // permitted in $data, so this prevents the user from updating all columns in the DB
        $currentUser->fill($data);
        $currentUser->save();

        // Create activity record
        $this->logger->info("User {$currentUser->user_name} updated their profile settings.", [
            'type'    => 'update_profile_settings',
            'user_id' => $currentUser->id,
        ]);

        $this->alert->addMessageTranslated('success', 'PROFILE.UPDATED');
    }

    /**
     * Load the request schema.
     *
     * @return RequestSchemaInterface
     */
    protected function getSchema(): RequestSchemaInterface
    {
        $schema = new RequestSchema($this->schema);

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
