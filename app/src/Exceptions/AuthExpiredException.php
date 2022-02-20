<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Exceptions;

/**
 * Expired authentication exception. Used when the user needs to authenticate/reauthenticate.
 */
final class AuthExpiredException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.EXPIRED.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.EXPIRED.DESCRIPTION';
}