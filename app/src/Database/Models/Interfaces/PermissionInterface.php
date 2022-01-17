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
 * Permission Model Interface.
 */
interface PermissionInterface
{
    /**
     * Get a list of roles to which this permission is assigned.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * Get a list of users who have this permission, along with a list of roles through which each user has the permission.
     *
     * @return \UserFrosting\Sprinkle\Core\Database\Relations\BelongsToManyThrough
     */
    public function users();
}
