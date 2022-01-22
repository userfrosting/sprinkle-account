<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use UserFrosting\Sprinkle\Core\Database\Models\Model;
use UserFrosting\Sprinkle\Core\Database\Relations\BelongsToManyThrough;

/**
 * Permission Model Interface.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface PermissionInterface
{
    /**
     * Get a list of roles to which this permission is assigned.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;

    /**
     * Get a list of users who have this permission, along with a list of roles through which each user has the permission.
     *
     * @return BelongsToManyThrough
     */
    public function users(): BelongsToManyThrough;
}
