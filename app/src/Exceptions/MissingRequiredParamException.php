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
 * Used when an the a model property is not found.
 */
final class MissingRequiredParamException extends AccountException
{
    protected string $title = 'USERNAME.IN_USE'; // TODO
    protected string $description = 'USERNAME.IN_USE'; // TODO
}
