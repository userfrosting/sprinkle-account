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
 * Compromised authentication exception. Used when we suspect theft of the rememberMe cookie.
 */
final class AuthCompromisedException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.COMPROMISED.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.COMPROMISED.DESCRIPTION';
}
