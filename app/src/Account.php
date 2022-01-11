<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account;

use UserFrosting\Sprinkle\Account\Bakery\BakeCommand;
use UserFrosting\Sprinkle\Account\Bakery\CreateAdminUser;
use UserFrosting\Sprinkle\SprinkleReceipe;

class Account implements SprinkleReceipe
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'Account Sprinkle';
    }

    /**
     * {@inheritdoc}
     */
    public static function getPath(): string
    {
        return __DIR__ . '/../';
    }

    /**
     * {@inheritdoc}
     */
    public static function getBakeryCommands(): array
    {
        return [
            // BakeCommand::class,
            // CreateAdminUser::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getSprinkles(): array
    {
        return [];
    }

    /**
     * Returns a list of routes definition in PHP files.
     *
     * @return string[]
     */
    public static function getRoutes(): array
    {
        return [];
    }

    /**
     * Returns a list of all PHP-DI services/container definitions files.
     *
     * @return string[]
     */
    public static function getServices(): array
    {
        return [];
    }
}
