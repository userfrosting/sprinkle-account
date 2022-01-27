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
 * Password hash failure exception.
 * Used when the supplied password could not be hashed for some reason.
 */
class HashFailedException extends AuthException
{
    protected $defaultMessage = 'PASSWORD.HASH_FAILED';
    protected $httpErrorCode = 500;
}
