<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\ServicesProvider;

use UserFrosting\ServicesProvider\ServicesProviderInterface;
use UserFrosting\Sprinkle\Account\Log\UserActivityDatabaseHandler;
use UserFrosting\Sprinkle\Account\Log\UserActivityLogger;

final class UserActivityLoggerService implements ServicesProviderInterface
{
    public function register(): array
    {
        return [
            /**
             * Register the User Activity Logger.
             */
            // TODO : We could bring back the processor, to add the current user into the context
            UserActivityLogger::class => function (UserActivityDatabaseHandler $handler) {
                $logger = new UserActivityLogger('userActivity', [$handler]);

                return $logger;
            },
        ];
    }
}
