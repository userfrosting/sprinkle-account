<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Controller\Exception;

use UserFrosting\Support\Exception\HttpException;

/**
 * Spammy request exception.  Used when a bot has attempted to spam a public form, and fallen into our honeypot.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class SpammyRequestException extends HttpException
{
}
