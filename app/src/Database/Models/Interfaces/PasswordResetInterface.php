<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use UserFrosting\Sprinkle\Account\Repository\TokenAccessor;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Password Reset Model Interface.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property int           $id
 * @property int           $user_id
 * @property hash          $token
 * @property string        $hash
 * @property bool          $completed
 * @property datetime|null $expires_at
 * @property datetime|null $completed_at
 * @property UserInterface $user
 */
interface PasswordResetInterface extends TokenAccessor
{
    /**
     * User associated with this reset request.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo;
}
