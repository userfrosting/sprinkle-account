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
            $this->get('/check-username', 'UserFrosting\Sprinkle\Account\Controller\AccountController:checkUsername');

            $this->get('/forgot-password', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageForgotPassword')
                ->setName('forgot-password');

            $this->get('/resend-verification', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageResendVerification');

            $this->get('/set-password/confirm', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageResetPassword');

            $this->get('/set-password/deny', 'UserFrosting\Sprinkle\Account\Controller\AccountController:denyResetPassword');

            $this->get('/settings', 'UserFrosting\Sprinkle\Account\Controller\AccountController:pageSettings')
                ->add('authGuard');

            $this->get('/suggest-username', 'UserFrosting\Sprinkle\Account\Controller\AccountController:suggestUsername');

            $this->get('/verify', 'UserFrosting\Sprinkle\Account\Controller\AccountController:verify');

            $this->post('/forgot-password', 'UserFrosting\Sprinkle\Account\Controller\AccountController:forgotPassword');

            $this->post('/resend-verification', 'UserFrosting\Sprinkle\Account\Controller\AccountController:resendVerification');

            $this->post('/set-password', 'UserFrosting\Sprinkle\Account\Controller\AccountController:setPassword');

            $this->post('/settings', 'UserFrosting\Sprinkle\Account\Controller\AccountController:settings')
                ->add('authGuard')
                ->setName('settings');

            $this->post('/settings/profile', 'UserFrosting\Sprinkle\Account\Controller\AccountController:profile')
                ->add('authGuard');
        })->add(new NoCache());

        $app->get('/modals/account/tos', 'UserFrosting\Sprinkle\Account\Controller\AccountController:getModalAccountTos');
    }
}
