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

use Illuminate\Database\Eloquent\Model;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\VerificationInterface;

/**
 * Token repository class for new account verifications.
 */
class VerificationRepository extends TokenRepository
{
    /**
     * Inject Verification model.
     *
     * @param VerificationInterface $modelIdentifier
     */
    public function __construct(
        protected VerificationInterface $modelIdentifier,
        protected UserInterface $userModel,
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
    protected function getUserModel(): UserInterface
    {
        return $this->userModel;
    }

    /**
     * {@inheritdoc}
     */
    protected function updateUser(UserInterface $user, array $args): void
    {
        $user->flag_verified = true;
        // TODO: generate user activity
        $user->save();
    }
}
