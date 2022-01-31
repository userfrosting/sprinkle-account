<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Helpers;

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Support\Exception\BadInstanceOfException;

trait DynamicUserModel
{
    /**
     * @var class-string<UserInterface> User Model to use. Default to User
     */
    protected string $userModel = User::class;

    /**
     * Get user Model to use.
     *
     * @return class-string<UserInterface>
     */
    public function getUserModel(): string
    {
        return $this->userModel;
    }

    /**
     * Set user Model to use.
     *
     * @param string $userModel User Model to use.
     *
     * @return static
     */
    public function setUserModel(string $userModel): static
    {
        if (!is_subclass_of($userModel, UserInterface::class)) {
            throw new BadInstanceOfException("User Model doesn't implement " . UserInterface::class);
        }

        $this->userModel = $userModel;

        return $this;
    }
}
