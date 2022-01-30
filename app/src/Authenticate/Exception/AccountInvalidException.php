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
 * Invalid account exception. Used when an account has been removed during an active session.
 */
final class AccountInvalidException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.INVALID.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.INVALID.DESCRIPTION';
}
