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
 * Forbidden Exception. Used when an account doesn't have access to a resource.
 */
final class ForbiddenException extends AccountException
{
    protected string $title = 'ACCOUNT.EXCEPTION.ACCESS_DENIED.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.ACCESS_DENIED.DESCRIPTION';
}
