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
use UserFrosting\Sprinkle\Account\Database\Factories\RoleFactory;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\PermissionInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\RoleInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Core\Database\Models\Model;
use UserFrosting\Support\Repository\Repository as Config;

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
    use HasFactory;
    
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
     * 
     * @return string[]
     */
    public static function getDefaultSlugs(): array
    {
        /** @var Config $config */
        $config = static::$ci->get(UserInterface::class);

        return array_map('trim', array_keys($config->get('site.registration.user_defaults.roles'), true));
    }

    /**
     * Get a list of permissions assigned to this role.
     * 
     * @return PermissionInterface|BelongsToMany
     */
    public function permissions()
    {
        /** @var string */
        $relation = static::$ci->get(PermissionInterface::class);

        return $this->belongsToMany($relation, 'permission_roles', 'role_id', 'permission_id')->withTimestamps();
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
     * 
     * @return UserInterface|BelongsToMany
     */
    public function users()
    {
        /** @var string */
        $relation = static::$ci->get(UserInterface::class);

        return $this->belongsToMany($relation, 'role_users', 'role_id', 'user_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
