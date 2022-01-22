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

/**
 * Role Model Interface.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface RoleInterface
{
    /**
     * Get a list of default roles.
     *
     * @return string[]
     */
    public static function getDefaultSlugs(): array;

    /**
     * Get a list of permissions assigned to this role.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany;

    /**
     * Get a list of users who have this role.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany;
}
