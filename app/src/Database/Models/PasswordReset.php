<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Password Reset Class.
 *
 * Represents a password reset request for a specific user.
 *
 * @mixin \Illuminate\Database\Query\Builder
 *
 * @property int      $user_id
 * @property hash     $token
 * @property bool     $completed
 * @property datetime $expires_at
 * @property datetime $completed_at
 */
class PasswordReset extends Model
{
    /**
     * @var string The name of the table for the current model.
     */
    protected $table = 'password_resets';

    protected $fillable = [
        'user_id',
        'hash',
        'completed',
        'expires_at',
        'completed_at',
    ];

    /**
     * @var bool Enable timestamps for PasswordResets.
     */
    public $timestamps = true;

    /**
     * @var string Stores the raw (unhashed) token when created, so that it can be emailed out to the user.  NOT persisted.
     */
    protected $token;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setToken($value)
    {
        $this->token = $value;

        return $this;
    }

    /**
     * Get the user associated with this reset request.
     *
     * @return UserInterface|BelongsTo
     */
    public function user()
    {
        /** @var string */
        $relation = static::$ci->get(UserInterface::class);

        return $this->belongsTo($relation, 'user_id');
    }
}
