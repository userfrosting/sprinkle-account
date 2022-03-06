<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Routes;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use UserFrosting\Routes\RouteDefinitionInterface;
use UserFrosting\Sprinkle\Account\Authenticate\AuthGuard;
use UserFrosting\Sprinkle\Account\Authenticate\GuestGuard;
use UserFrosting\Sprinkle\Account\Controller\LoginAction;
use UserFrosting\Sprinkle\Account\Controller\LogoutAction;
use UserFrosting\Sprinkle\Account\Controller\RegisterAction;
use UserFrosting\Sprinkle\Core\Util\NoCache;

class AuthRoutes implements RouteDefinitionInterface
{
    public function register(App $app): void
    {
        $app->group('/account', function (RouteCollectorProxy $group) {
            $group->post('/login', LoginAction::class)->setName('account.login');
            $group->post('/register', RegisterAction::class)->setName('account.register');
        })->add(GuestGuard::class); //->add(new NoCache()); TODO

        $app->group('/account', function (RouteCollectorProxy $group) {
            $group->get('/logout', LogoutAction::class)->setName('account.logout');
        })->add(AuthGuard::class); //->add(new NoCache()); TODO
    }
}
