<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Log;

use UserFrosting\Sprinkle\Core\Log\Logger;

/**
 * User Activity Logger.
 *
 * @todo : We could bring back the processor, to add the current user into the context
 */
class UserActivityLogger extends Logger implements UserActivityLoggerInterface
{
    /**
     * @todo Replace with Enum
     */
    public const TYPE_REGISTER = 'sign_up';
    public const TYPE_VERIFIED = 'verified';
    public const TYPE_PASSWORD_RESET = 'password_reset';
    public const TYPE_LOGGED_IN = 'sign_in';
    public const TYPE_LOGGED_OUT = 'sign_out';
    public const TYPE_PASSWORD_UPGRADED = 'password_upgraded';

    public function __construct(UserActivityDatabaseHandler $handler)
    {
        parent::__construct($handler, 'userActivity');
    }
}
