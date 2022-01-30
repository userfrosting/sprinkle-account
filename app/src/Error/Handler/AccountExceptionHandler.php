<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Error\Handler;

use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use UserFrosting\Sprinkle\Core\Error\Handler\ExceptionHandler;

/**
 * Handler for AuthException. Override the default error message, and
 */
final class AccountExceptionHandler extends ExceptionHandler
{
    /**
     * Never log exceptions for AuthException.
     */
    protected function shouldLogExceptions(): bool
    {
        return false;
    }

    /**
     * Never display error details for AuthException.
     */
    protected function displayErrorDetails(): bool
    {
        return false;
    }

    /**
     * Force the use if Exception code for AuthException.
     */
    protected function determineStatusCode(ServerRequestInterface $request, Throwable $exception): int
    {
        return intval($exception->getCode());
    }
}
