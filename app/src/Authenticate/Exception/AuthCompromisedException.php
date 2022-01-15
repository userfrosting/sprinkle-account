<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Authenticate\Exception;

use UserFrosting\Support\Exception\ForbiddenException;

/**
 * Compromised authentication exception.  Used when we suspect theft of the rememberMe cookie.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AuthCompromisedException extends ForbiddenException
{
    protected $defaultMessage = 'ACCOUNT.SESSION_COMPROMISED';
}
