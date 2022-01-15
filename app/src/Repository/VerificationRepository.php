<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Repository;

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;

/**
 * Token repository class for new account verifications.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 *
 * @see https://learn.userfrosting.com/users/user-accounts
 */
class VerificationRepository extends TokenRepository
{
    /**
     * {@inheritdoc}
     */
    protected $modelIdentifier = 'verification';

    /**
     * {@inheritdoc}
     */
    protected function updateUser(UserInterface $user, $args)
    {
        $user->flag_verified = 1;
        // TODO: generate user activity? or do this in controller?
        $user->save();
    }
}
