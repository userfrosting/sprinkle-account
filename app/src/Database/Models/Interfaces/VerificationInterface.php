<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Verification Model Interface.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface VerificationInterface
{
    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $value
     *
     * @return self
     */
    public function setToken($value): static;

    /**
     * User associated with this verification request.
     *
     * @return UserInterface
     */
    public function user();
}
