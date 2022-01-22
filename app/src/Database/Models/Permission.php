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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use UserFrosting\Sprinkle\Account\Database\Factories\PermissionFactory;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\PermissionInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\RoleInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Core\Database\Models\Model;
use UserFrosting\Sprinkle\Core\Database\Relations\BelongsToManyThrough;

/**
 * Permission Class.
 *
 * Represents a permission for a role or user.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property int    $id
 * @property string $slug
 * @property string $name
 * @property string $conditions
 * @property string $description
 */
class Permission extends Model implements PermissionInterface
{
    use HasFactory;

    /**
     * @var string The name of the table for the current model.
     */
    protected $table = 'permissions';

    /**
     * @var string[] The attributes that are mass assignable.
     */
    protected $fillable = [
        'slug',
        'name',
        'conditions',
        'description',
    ];

    /**
     * Delete this permission from the database, removing associations with roles.
     */
    public function delete()
    {
        // Remove all role associations
        $this->roles()->detach();

        // Delete the permission
        $result = parent::delete();

        return $result;
    }

    /**
     * Get a list of roles to which this permission is assigned.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        /** @var string */
        $relation = static::$ci->get(RoleInterface::class);

        return $this->belongsToMany($relation, 'permission_roles', 'permission_id', 'role_id')->withTimestamps();
    }

    /**
     * Query scope to get all permissions assigned to a specific role.
     *
     * @param Builder $query
     * @param int     $roleId
     *
     * @return Builder
     */
    public function scopeForRole($query, $roleId)
    {
        return $query->join('permission_roles', function ($join) use ($roleId) {
            $join->on('permission_roles.permission_id', 'permissions.id')
                 ->where('role_id', $roleId);
        });
    }

    /**
     * Query scope to get all permissions NOT associated with a specific role.
     *
     * @param Builder $query
     * @param int     $roleId
     *
     * @return Builder
     */
    public function scopeNotForRole($query, $roleId)
    {
        return $query->join('permission_roles', function ($join) use ($roleId) {
            $join->on('permission_roles.permission_id', 'permissions.id')
                 ->where('role_id', '!=', $roleId);
        });
    }

    /**
     * Get a list of users who have this permission, along with a list of roles through which each user has the permission.
     *
     * @return BelongsToManyThrough
     */
    public function users(): BelongsToManyThrough
    {
        /** @var string */
        $userRelation = static::$ci->get(UserInterface::class);

        /** @var string */
        $roleRelation = static::$ci->get(RoleInterface::class);

        return $this->belongsToManyThrough(
            $userRelation,
            $roleRelation,
            'permission_roles',
            'permission_id',
            'role_id',
            'role_users',
            'role_id',
            'user_id'
        );
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PermissionFactory::new();
    }
}
