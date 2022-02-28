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

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\VerificationInterface;
use UserFrosting\Sprinkle\Account\Log\UserActivityLogger;

/**
 * Token repository class for new account verifications.
 */
final class VerificationRepository extends TokenRepository
{
    /**
     * Inject Dependencies.
     *
     * @param VerificationInterface $modelIdentifier
     * @param UserInterface         $userModel
     * @param UserActivityLogger    $userActivityLogger
     */
    public function __construct(
        protected VerificationInterface $modelIdentifier,
        protected UserInterface $userModel,
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
        $user->flag_verified = true;

        // Create activity record
        $this->userActivityLogger->info("User {$user->user_name} verified it's account.", [
            'type'    => UserActivityLogger::TYPE_VERIFIED,
            'user_id' => $user->id,
        ]);

        $user->save();
    }
}
