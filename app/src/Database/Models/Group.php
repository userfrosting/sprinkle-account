<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use UserFrosting\Sprinkle\Account\Database\Factories\GroupFactory;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\GroupInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Group Class.
 *
 * Represents a group object as stored in the database.
 *
 * @mixin \Illuminate\Database\Query\Builder
 *
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string $icon
 */
class Group extends Model implements GroupInterface
{
    use HasFactory;
    
    /**
     * @var string The name of the table for the current model.
     */
    protected $table = 'groups';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'icon',
    ];

    /**
     * @var bool Enable timestamps for this class.
     */
    public $timestamps = true;

    /**
     * Delete this group from the database, along with any user associations.
     *
     * @todo What do we do with users when their group is deleted?  Reassign them?  Or, can a user be "groupless"?
     */
    /*public function delete()
    {
        // Delete the group
        $result = parent::delete();

        return $result;
    }*/

    /**
     * Lazily load a collection of Users which belong to this group.
     *
     * @return UserInterface|HasMany
     */
    public function users()
    {
        /** @var string */
        $relation = static::$ci->get(UserInterface::class);

        return $this->hasMany($relation, 'group_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return GroupFactory::new();
    }
}
