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

use Monolog\Logger;

/**
 * Monolog alias for dependency injection.
 */
class UserActivityLogger extends Logger
{
    public const TYPE_REGISTER = 'sign_up';
    public const TYPE_VERIFIED = 'verified';
    public const TYPE_PASSWORD_RESET = 'password_reset';
    public const TYPE_LOGGED_IN = 'sign_in';
    public const TYPE_LOGGED_OUT = 'sign_out';
    public const TYPE_PASSWORD_UPGRADED = 'password_upgraded';
}
