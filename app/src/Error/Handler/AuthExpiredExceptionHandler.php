<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Error\Handler;

use Psr\Http\Message\ResponseInterface;
use UserFrosting\Sprinkle\Core\Error\Handler\ExceptionHandler;

/**
 * Handler for AuthExpiredExceptions.
 *
 * Forwards the user to the login page when their session has expired.
 */
class AuthExpiredExceptionHandler extends ExceptionHandler
{
    /**
     * Custom handling for requests that did not pass authentication.
     *
     * @return ResponseInterface
     */
    public function handle()
    {
        // For auth expired exceptions, we always add messages to the alert stream.
        $this->writeAlerts();

        $response = $this->response;

        // For non-AJAX requests, we forward the user to the login page.
        if (!$this->request->isXhr()) {
            $uri = $this->request->getUri();
            $path = $uri->getPath();
            $query = $uri->getQuery();
            $fragment = $uri->getFragment();

            $path = $path
                . ($query ? '?' . $query : '')
                . ($fragment ? '#' . $fragment : '');

            $loginPage = $this->ci->router->pathFor('login', [], [
                'redirect' => $path,
            ]);

            $response = $response->withRedirect($loginPage);
        }

        return $response;
    }
}
