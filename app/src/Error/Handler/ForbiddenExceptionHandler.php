<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Error\Handler;

use UserFrosting\Sprinkle\Core\Error\Handler\HttpExceptionHandler;
use UserFrosting\Support\Message\UserMessage;

/**
 * Handler for ForbiddenExceptions.  Only really needed to override the default error message.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class ForbiddenExceptionHandler extends HttpExceptionHandler
{
    /**
     * Resolve a list of error messages to present to the end user.
     *
     * @return array
     */
    protected function determineUserMessages()
    {
        return [
            new UserMessage('ACCOUNT.ACCESS_DENIED'),
        ];
    }
}
