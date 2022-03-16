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
use UserFrosting\Routes\RouteDefinitionInterface;
use UserFrosting\Sprinkle\Core\Util\NoCache;

class AccountRoutes implements RouteDefinitionInterface
{
    public function register(App $app): void
    {
        $app->group('/account', function () {
            // TODO : Move to theme repo
            // $this->get('/forgot-password', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageForgotPassword')
            //    ->setName('forgot-password');

            // TODO : Move to theme repo
            // $this->get('/resend-verification', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageResendVerification');

            // TODO : Move to theme repo
            // $this->get('/set-password/confirm', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageResetPassword');

            // TODO : Move to theme repo
            // $this->get('/settings', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageSettings')
            //    ->add('authGuard');

            $this->post('/settings', 'UserFrosting\Sprinkle\Account\Controller\AccountController:settings')
                ->add('authGuard')
                ->setName('settings');

            $this->post('/settings/profile', 'UserFrosting\Sprinkle\Account\Controller\AccountController:profile')
                ->add('authGuard');
        })->add(new NoCache());

        // TODO : Move to theme repo
        // $app->get('/modals/account/tos', 'UserFrosting\Sprinkle\Account\Controller\AccountController:getModalAccountTos');
    }
}
