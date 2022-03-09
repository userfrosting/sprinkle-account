<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Twig;

use Exception;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;
use UserFrosting\Sprinkle\Account\Authenticate\Authenticator;
use UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager;

/**
 * Extends Twig functionality for the Account sprinkle.
 */
class AccountExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @ param AuthorizationManager $authorizer
     * @param Authenticator $authenticator
     */
    public function __construct(
        // protected AuthorizationManager $authorizer,
        protected Authenticator $authenticator,
    ) {
    }

    /**
     * Adds Twig functions `getAlerts`.
     *
     * @return TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            // Add Twig function for checking permissions during dynamic menu rendering
            // TODO
            // new TwigFunction('checkAccess', function ($slug, $params = []) {
            //     return $this->authorizer->checkAccess($this->authenticator->user(), $slug, $params);
            // }),
            new TwigFunction('checkAuthenticated', function () {
                return $this->authenticator->check();
            }),
        ];
    }

    /**
     * Adds Twig global variables `site`.
     *
     * @return mixed[]
     */
    public function getGlobals(): array
    {
        try {
            $currentUser = $this->authenticator->user();
        } catch (Exception $e) {
            $currentUser = null;
        }

        return [
            'current_user' => $currentUser,
        ];
    }
}
