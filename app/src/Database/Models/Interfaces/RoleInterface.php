<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Role Model Interface.
 */
interface RoleInterface
{
    /**
     * Get a list of default roles.
     */
    public static function getDefaultSlugs();

    /**
     * Get a list of permissions assigned to this role.
     */
    public function permissions();

    /**
     * Get a list of users who have this role.
     */
    public function users();
}
