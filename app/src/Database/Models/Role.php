<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\PermissionInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\RoleInterface;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Role Class.
 *
 * Represents a role, which aggregates permissions and to which a user can be assigned.
 *
 * @mixin \Illuminate\Database\Query\Builder
 *
 * @property string $slug
 * @property string $name
 * @property string $description
 */
class Role extends Model implements RoleInterface
{
    /**
     * @var string The name of the table for the current model.
     */
    protected $table = 'roles';

    protected $fillable = [
        'slug',
        'name',
        'description',
    ];

    /**
     * @var bool Enable timestamps for this class.
     */
    public $timestamps = true;

    /**
     * Delete this role from the database, removing associations with permissions and users.
     */
    public function delete()
    {
        // Remove all permission associations
        $this->permissions()->detach();

        // Remove all user associations
        $this->users()->detach();

        // Delete the role
        $result = parent::delete();

        return $result;
    }

    /**
     * Get a list of default roles.
     */
    public static function getDefaultSlugs()
    {
        /** @var \UserFrosting\Support\Repository\Repository $config */
        $config = static::$ci->config;

        return array_map('trim', array_keys($config['site.registration.user_defaults.roles'], true));
    }

    /**
     * Get a list of permissions assigned to this role.
     */
    public function permissions(): BelongsToMany
    {
        /** @var PermissionInterface */
        $relation = static::$ci->make(PermissionInterface::class);

        return $this->belongsToMany($relation::class, 'permission_roles', 'role_id', 'permission_id')->withTimestamps();
    }

    /**
     * Query scope to get all roles assigned to a specific user.
     *
     * @param Builder $query
     * @param int     $userId
     *
     * @return Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->join('role_users', function ($join) use ($userId) {
            $join->on('role_users.role_id', 'roles.id')
                 ->where('user_id', $userId);
        });
    }

    /**
     * Get a list of users who have this role.
     */
    public function users()
    {
        /** @var \UserFrosting\Sprinkle\Core\Util\ClassMapper $classMapper */
        $classMapper = static::$ci->classMapper;

        return $this->belongsToMany($classMapper->getClassMapping('user'), 'role_users', 'role_id', 'user_id');
    }
}
