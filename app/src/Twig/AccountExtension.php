<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Twig;

use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;
use UserFrosting\Config\Config;

/**
 * Extends Twig functionality for the Account sprinkle.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AccountExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var ContainerInterface
     */
    protected $services;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param ContainerInterface $services
     */
    public function __construct(ContainerInterface $services)
    {
        $this->services = $services;
        $this->config = $services->config;
    }

    public function getName()
    {
        return 'userfrosting/account';
    }

    public function getFunctions()
    {
        return [
            // Add Twig function for checking permissions during dynamic menu rendering
            new TwigFunction('checkAccess', function ($slug, $params = []) {
                $authorizer = $this->services->authorizer;
                $currentUser = $this->services->currentUser;

                return $authorizer->checkAccess($currentUser, $slug, $params);
            }),
            new TwigFunction('checkAuthenticated', function () {
                $authenticator = $this->services->authenticator;

                return $authenticator->check();
            }),
        ];
    }

    public function getGlobals()
    {
        try {
            $currentUser = $this->services->currentUser;
        } catch (\Exception $e) {
            $currentUser = null;
        }

        return [
            'current_user'   => $currentUser,
        ];
    }
}
