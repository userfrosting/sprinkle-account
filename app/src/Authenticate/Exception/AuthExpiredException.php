<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Authenticate\Exception;

use UserFrosting\Support\Exception\HttpException;

/**
 * Expired authentication exception.  Used when the user needs to authenticate/reauthenticate.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AuthExpiredException extends HttpException
{
    protected $defaultMessage = 'ACCOUNT.SESSION_EXPIRED';
    protected $httpErrorCode = 401;
}
