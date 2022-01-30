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
 * Unverified account exception. Used when an account is required to complete email verification, but hasn't done so yet.
 */
final class AccountNotVerifiedException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.UNVERIFIED.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.UNVERIFIED.DESCRIPTION';
}
