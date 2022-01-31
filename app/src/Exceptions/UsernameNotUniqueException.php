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
 * Used when an the username is not unique.
 */
final class UsernameNotUniqueException extends AccountException
{
    protected string $title = 'USERNAME.IN_USE';
    protected string $description = 'USERNAME.IN_USE'; // TODO
}
