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
 * Registration exception.
 * Used when an exception is encountered by the registration mechanism.
 * Title and Description can be changed using setter.
 */
final class RegistrationException extends AccountException
{
    protected string $title = 'REGISTRATION.ERROR';
    protected string $description = 'REGISTRATION.UNKNOWN';
}
