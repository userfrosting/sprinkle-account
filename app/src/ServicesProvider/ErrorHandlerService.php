<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\ServicesProvider;

use UserFrosting\ServicesProvider\ServicesProviderInterface;
use UserFrosting\Sprinkle\Account\Authenticate\Exception\AccountException;
use UserFrosting\Sprinkle\Account\Error\Handler\AccountExceptionHandler;
use UserFrosting\Sprinkle\Core\Error\ExceptionHandlerMiddleware;

class ErrorHandlerService implements ServicesProviderInterface
{
    public function register(): array
    {
        return [
            /**
             * Register the AuthExceptionHandler.
             */
            ExceptionHandlerMiddleware::class => \DI\decorate(function (ExceptionHandlerMiddleware $middleware) {
                $middleware->registerHandler(AccountException::class, AccountExceptionHandler::class, true);

                // Register the AuthExpiredExceptionHandler
                // $middlewares->registerHandler('\UserFrosting\Sprinkle\Account\Authenticate\Exception\AuthExpiredException', '\UserFrosting\Sprinkle\Account\Error\Handler\AuthExpiredExceptionHandler');

                return $middleware;
            }),
        ];
    }
}
