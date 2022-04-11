<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Bakery;

use Symfony\Component\Console\Command\Command;
use UserFrosting\Config\Config;
use UserFrosting\Sprinkle\Account\Bakery\Exception\BakeryNote;
use UserFrosting\Sprinkle\Account\Database\Models\User;

/**
 * Create root user CLI command. Same as CreateUser, but will abort if the root user already exists.
 * This allows to add this command to the bake command.
 */
class CreateAdminUser extends CreateUser
{
    /** @var string The command name */
    protected string $commandName = 'create:admin-user';

    /** @var string The command name */
    protected string $commandTitle = 'Creating new admin (root) user';

    /**
     * {@inheritdoc}
     */
    protected function validateRequirements(): void
    {
        parent::validateRequirements();

        // Make sure that there are no users currently in the user table
        // We setup the root account here so it can be done independent of the version check
        // TODO : We should get the id from config.
        if (User::count() > 0) {
            throw new BakeryNote("Table 'users' is not empty. Skipping root account setup.");
        }
    }
}
