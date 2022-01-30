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
 * Invalid credentials exception. Used when an account fails authentication for some reason.
 */
final class InvalidCredentialsException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.INVALID_CREDENTIALS.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.INVALID_CREDENTIALS.DESCRIPTION';
}
