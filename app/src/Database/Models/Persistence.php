<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\PersistenceInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Persistence db Model.
 *
 * Represents the persistence table.
 *
 * @mixin \Illuminate\Database\Query\Builder
 *
 * @property string $user_id
 * @property string $token
 * @property string $persistent_token
 * @property string $expires_at
 */
class Persistence extends Model implements PersistenceInterface
{
    /**
     * @var string The name of the table for the current model.
     */
    protected $table = 'persistences';

    protected $fillable = [
        'user_id',
        'token',
        'persistent_token',
        'expires_at',
    ];

    /**
     * @var bool Enable timestamps for this class.
     */
    public $timestamps = true;

    /**
     * Relation with the user table.
     *
     * @return UserInterface|HasOne
     */
    public function user()
    {
        /** @var string */
        $relation = static::$ci->get(UserInterface::class);

        return $this->hasOne($relation);
    }

    /**
     * Scope a query to only include not expired entries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotExpired($query)
    {
        return $query->where('expires_at', '>', Carbon::now());
    }
}
