<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use UserFrosting\Sprinkle\Core\Database\Relations\BelongsToManyThrough;

/**
 * User Model Interface.
 *
 * @mixin \Illuminate\Database\Query\Builder
 *
 * @property int       $id
 * @property string    $user_name
 * @property string    $first_name
 * @property string    $last_name
 * @property string    $full_name
 * @property string    $email
 * @property string    $locale
 * @property string    $theme
 * @property int       $group_id
 * @property bool      $flag_verified
 * @property bool      $flag_enabled
 * @property int       $last_activity_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property string    $password
 * @property timestamp $deleted_at
 */
interface UserInterface
{
    /**
     * Get all activities for this user.
     *
     * @return ActivityInterface|HasMany
     */
    public function activities();

    /**
     * Return a cache instance specific to that user.
     *
     * @return \Illuminate\Contracts\Cache\Store
     */
    public function getCache();

    /**
     * Allows you to get the full name of the user using `$user->full_name`.
     *
     * @return string
     */
    public function getFullNameAttribute();

    /**
     * Retrieve the cached permissions dictionary for this user.
     *
     * @return array
     */
    public function getCachedPermissions();

    /**
     * Retrieve the cached permissions dictionary for this user.
     *
     * @return $this
     */
    public function reloadCachedPermissions();

    /**
     * Get the amount of time, in seconds, that has elapsed since the last activity of a certain time for this user.
     *
     * @param string $type The type of activity to search for.
     *
     * @return int
     */
    public function getSecondsSinceLastActivity($type);

    /**
     * Return this user's group.
     *
     * @return GroupInterface|BelongsTo
     */
    public function group();

    /**
     * Returns whether or not this user is the master user.
     *
     * @return bool
     */
    public function isMaster();

    /**
     * Get the most recent activity for this user, based on the user's last_activity_id.
     *
     * @return ActivityInterface|BelongsTo
     */
    public function lastActivity();

    /**
     * Find the most recent activity for this user of a particular type.
     *
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function lastActivityOfType($type = null);

    /**
     * Get the most recent time for a specified activity type for this user.
     *
     * @param string $type
     *
     * @return string|null The last activity time, as a SQL formatted time (YYYY-MM-DD HH:MM:SS), or null if an activity of this type doesn't exist.
     */
    public function lastActivityTime($type);

    /**
     * Performs tasks to be done after this user has been successfully authenticated.
     *
     * By default, adds a new sign-in activity and updates any legacy hash.
     *
     * @param mixed[] $params Optional array of parameters used for this event handler.
     *
     * @todo Transition to Laravel Event dispatcher to handle this
     */
    public function onLogin($params = []);

    /**
     * Performs tasks to be done after this user has been logged out.
     *
     * By default, adds a new sign-out activity.
     *
     * @param mixed[] $params Optional array of parameters used for this event handler.
     *
     * @todo Transition to Laravel Event dispatcher to handle this
     */
    public function onLogout($params = []);

    /**
     * Get all password reset requests for this user.
     *
     * @return PasswordResetInterface|HasMany
     */
    public function passwordResets();

    /**
     * Get all of the permissions this user has, via its roles.
     *
     * @return PermissionInterface|BelongsToManyThrough
     */
    public function permissions();

    /**
     * Get all roles to which this user belongs.
     *
     * @return RoleInterface|BelongsToMany
     */
    public function roles();

    /**
     * Query scope to get all users who have a specific role.
     *
     * @param Builder $query
     * @param int     $roleId
     *
     * @return Builder
     */
    public function scopeForRole($query, $roleId);

    /**
     * Joins the user's most recent activity directly, so we can do things like sort, search, paginate, etc.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeJoinLastActivity($query);
}
