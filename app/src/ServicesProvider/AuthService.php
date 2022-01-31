<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\ServicesProvider;

use Birke\Rememberme\Storage\StorageInterface;
use UserFrosting\ServicesProvider\ServicesProviderInterface;
use UserFrosting\Sprinkle\Account\Authenticate\Authenticator;
use UserFrosting\Sprinkle\Account\Authenticate\Hasher;
use UserFrosting\Sprinkle\Account\Authenticate\Interfaces\HasherInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Rememberme\PDOStorage;
use UserFrosting\Sprinkle\Account\Validators\UserValidation;

/**
 * Authenticator related Service.
 */
class AuthService implements ServicesProviderInterface
{
    public function register(): array
    {
        return [
            Authenticator::class => \DI\autowire()
                ->method('setUserModel', \DI\get(UserInterface::class)),

            StorageInterface::class => \DI\autowire(PDOStorage::class),
            HasherInterface::class  => \DI\autowire(Hasher::class),

            UserValidation::class => \DI\autowire()
                ->method('setUserModel', \DI\get(UserInterface::class)),
        ];
    }
}
