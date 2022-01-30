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
 * Disabled account exception. Used when an account has been disabled.
 */
final class AccountDisabledException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.DISABLED.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.DISABLED.DESCRIPTION';
}
