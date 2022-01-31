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
final class EmailNotUniqueException extends AccountException
{
    protected string $title = 'EMAIL.IN_USE';
    protected string $description = 'EMAIL.IN_USE'; // TODO
}
