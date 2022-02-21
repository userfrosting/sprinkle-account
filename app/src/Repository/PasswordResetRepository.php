<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Repository;

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\PasswordResetInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Facades\Password;

/**
 * Token repository class for password reset requests.
 */
class PasswordResetRepository extends TokenRepository
{
    /**
     * Inject Verification model.
     *
     * @param PasswordResetInterface $modelIdentifier
     */
    public function __construct(protected PasswordResetInterface $modelIdentifier)
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelIdentifier()
    {
        return $this->modelIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    protected function updateUser(UserInterface $user, array $args): void
    {
        $user->password = Password::hash($args['password']);
        // TODO: generate user activity? or do this in controller?
        $user->save();
    }
}
