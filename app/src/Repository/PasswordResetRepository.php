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
use UserFrosting\Sprinkle\Account\Log\UserActivityLogger;

/**
 * Token repository class for password reset requests.
 */
final class PasswordResetRepository extends TokenRepository
{
    /**
     * Inject Dependencies.
     *
     * @param PasswordResetInterface $modelIdentifier
     * @param UserActivityLogger     $userActivityLogger
     */
    public function __construct(
        protected PasswordResetInterface $modelIdentifier,
        protected UserActivityLogger $userActivityLogger,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelIdentifier(): TokenAccessor
    {
        return $this->modelIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    protected function updateUser(UserInterface $user, array $args): void
    {
        $user->setPasswordAttribute($args['password']);

        // Create activity record
        $this->userActivityLogger->info("User {$user->user_name} reset it's password.", [
            'type'    => UserActivityLogger::TYPE_PASSWORD_RESET,
            'user_id' => $user->id,
        ]);

        $user->save();
    }
}
