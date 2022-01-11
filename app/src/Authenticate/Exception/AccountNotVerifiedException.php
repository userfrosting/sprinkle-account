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
 * Unverified account exception.  Used when an account is required to complete email verification, but hasn't done so yet.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AccountNotVerifiedException extends HttpException
{
    protected $defaultMessage = 'ACCOUNT.UNVERIFIED';
    protected $httpErrorCode = 403;
}
