<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Authenticate\Exception;

/**
 * Expired authentication exception. Used when the user needs to authenticate/reauthenticate.
 */
class AuthExpiredException extends AuthException
{
    protected $defaultMessage = 'ACCOUNT.SESSION_EXPIRED';
    protected $httpErrorCode = 401;
}
