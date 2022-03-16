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
use UserFrosting\Sprinkle\Account\Controller\CaptchaAction;
use UserFrosting\Sprinkle\Account\Controller\CheckUsernameAction;
use UserFrosting\Sprinkle\Account\Controller\DenyResetPasswordAction;
use UserFrosting\Sprinkle\Account\Controller\ForgetPasswordAction;
use UserFrosting\Sprinkle\Account\Controller\LoginAction;
use UserFrosting\Sprinkle\Account\Controller\LogoutAction;
use UserFrosting\Sprinkle\Account\Controller\RegisterAction;
use UserFrosting\Sprinkle\Account\Controller\ResendVerificationAction;
use UserFrosting\Sprinkle\Account\Controller\SetPasswordAction;
use UserFrosting\Sprinkle\Account\Controller\SettingsAction;
use UserFrosting\Sprinkle\Account\Controller\SuggestUsernameAction;
use UserFrosting\Sprinkle\Account\Controller\VerifyAction;
use UserFrosting\Sprinkle\Core\Util\NoCache;

class AuthRoutes implements RouteDefinitionInterface
{
    public function register(App $app): void
    {
        // Guest Guard
        $app->group('/account', function (RouteCollectorProxy $group) {
            $group->post('/login', LoginAction::class)->setName('account.login');
            $group->post('/register', RegisterAction::class)->setName('account.register');
            $group->get('/verify', VerifyAction::class)->setName('account.verify');
            $group->post('/resend-verification', ResendVerificationAction::class)->setName('account.resendVerification');
            $group->post('/forgot-password', ForgetPasswordAction::class)->setName('account.forgotPassword');
            $group->get('/set-password/deny', DenyResetPasswordAction::class)->setName('account.setPassword.deny');
            $group->post('/set-password', SetPasswordAction::class)->setName('account.setPassword');
        })->add(GuestGuard::class); //->add(new NoCache()); TODO

        // Auth Guard
        $app->group('/account', function (RouteCollectorProxy $group) {
            $group->get('/logout', LogoutAction::class)->setName('account.logout');
            $group->post('/settings', SettingsAction::class)->setName('settings');
        })->add(AuthGuard::class); //->add(new NoCache()); TODO

        // No guard
        $app->group('/account', function (RouteCollectorProxy $group) {
            $group->get('/captcha', CaptchaAction::class)->setName('account.captcha');
            $group->get('/check-username', CheckUsernameAction::class)->setName('account.checkUsername');
            $group->get('/suggest-username', SuggestUsernameAction::class)->setName('account.suggestUsername');
        }); //->add(new NoCache()); TODO
    }
}
