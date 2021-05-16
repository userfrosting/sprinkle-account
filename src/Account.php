<?php

/*
 * UserFrosting (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/UserFrosting
 * @copyright Copyright (c) 2019 Alexander Weissman
 * @license   https://github.com/userfrosting/UserFrosting/blob/master/LICENSE.md (MIT License)
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
    public function getName(): string
    {
        return 'Account Sprinkle';
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return __DIR__;
    }

    /**
     * {@inheritdoc}
     */
    public function getBakeryCommands(): array
    {
        return [
            BakeCommand::class,
            CreateAdminUser::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getSprinkles(): array
    {
        return [];
    }
}
