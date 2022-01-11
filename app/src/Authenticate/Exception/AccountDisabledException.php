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
 * Disabled account exception.  Used when an account has been disabled.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AccountDisabledException extends HttpException
{
    protected $defaultMessage = 'ACCOUNT.DISABLED';
    protected $httpErrorCode = 403;
}
