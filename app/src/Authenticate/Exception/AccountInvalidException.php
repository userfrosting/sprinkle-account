<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Authenticate\Exception;

use UserFrosting\Support\Exception\HttpException;

/**
 * Invalid account exception.  Used when an account has been removed during an active session.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AccountInvalidException extends HttpException
{
    protected $defaultMessage = 'ACCOUNT.INVALID';
    protected $httpErrorCode = 403;
}
