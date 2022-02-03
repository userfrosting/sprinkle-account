<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Controller;

use UserFrosting\Alert\AlertStream;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Mail\Mailer;
use UserFrosting\Sprinkle\Core\Mail\TwigMailMessage;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;
use UserFrosting\Sprinkle\Core\Util\Captcha;
use UserFrosting\Support\Repository\Repository as Config;

/**
 * Tests RegisterAction
 */
class RegisterActionTest extends AccountTestCase
{
    use RefreshDatabase;

    /**
     * Setup test database for controller tests
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    public function testWithDisabledRegistration(): void
    {
        /** @var Config */
        $config = $this->ci->get(Config::class);
        $config->set('site.registration.enabled', false);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('POST', '/account/register');
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([
            'title'       => 'Registration error',
            'description' => "We're sorry, account registration has been disabled.",
            'status'      => 403,
        ], $response);
        $this->assertResponseStatus(403, $response);
    }

    public function testWithFailedHoneypot(): void
    {
        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('POST', '/account/register');
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([
            'title'       => 'Registration error',
            'description' => 'A problem was encountered during the account registration process.',
            'status'      => 403,
        ], $response);
        $this->assertResponseStatus(403, $response);
    }

    public function testWithNoMasterId(): void
    {
        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('POST', '/account/register', [
            'spiderbro' => 'http://',
        ]);
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([
            'title'       => 'Registration error',
            'description' => 'You cannot register an account until the master account has been created!',
            'status'      => 403,
        ], $response);
        $this->assertResponseStatus(403, $response);
    }

    public function testWihFailedCaptcha(): void
    {
        $this->setMasterUser();

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('POST', '/account/register', [
            'spiderbro' => 'http://',
        ]);
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([
            'title'       => 'Registration error',
            'description' => 'You did not enter the captcha code correctly.',
            'status'      => 403,
        ], $response);
        $this->assertResponseStatus(403, $response);
    }

    public function testRegister(): void
    {
        $this->setMasterUser();
        $captcha = $this->getCaptcha();
        $this->forceLocaleConfig();

        // Set POST data
        $data = [
            'spiderbro'     => 'http://',
            'captcha'       => $captcha->getCaptcha(),
            'user_name'     => 'RegisteredUser',
            'first_name'    => 'Testing',
            'last_name'     => 'Register',
            'email'         => 'testRegister@test.com',
            'password'      => 'FooBarFooBar123',
            'passwordc'     => 'FooBarFooBar123',
            'locale'        => '',
        ];

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('POST', '/account/register', $data);
        $response = $this->handleRequest($request);

        // Assert response status & body
        // $this->assertJsonResponse([], $response);
        $this->assertResponseStatus(200, $response);
        $this->assertJsonStructure([
            'user_name',
            'first_name',
            'last_name',
            'email',
            'locale',
            'flag_verified',
            'flag_enabled',
            'updated_at',
            'created_at',
            'id',
            'full_name',
            'avatar',
        ], $response);

        // Make sure the user is added to the db by querying it
        /** @var User */
        $user = User::where('email', 'testRegister@test.com')->first();
        $this->assertSame('RegisteredUser', $user['user_name']);
        $this->assertSame('en_US', $user['locale']);

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * Create a "master user" and set it's id as the master user.
     */
    protected function setMasterUser(): void
    {
        /** @var User */
        $masterUser = User::factory()->create();

        /** @var Config */
        $config = $this->ci->get(Config::class);
        $config->set('reserved_user_ids.master', $masterUser->id);
    }

    /**
     * Create captcha and init random code.
     *
     * @return Captcha
     */
    protected function getCaptcha(): Captcha
    {
        /** @var Config */
        $config = $this->ci->get(Config::class);

        /** @var Captcha */
        $captcha = $this->ci->get(Captcha::class);
        $captcha->setKey(strval($config->get('session.keys.captcha')));
        $captcha->generateRandomCode();

        return $captcha;
    }

    /**
     * Force specified locale as config.
     *
     * @param string $locale
     */
    protected function forceLocaleConfig(string $locale = 'en_US'): void
    {
        /** @var Config */
        $config = $this->ci->get(Config::class);

        $config->set('site.registration.user_defaults.locale', $locale);
        $config->set('site.locales.available', [$locale => true]);
    }

    /**
     * N.B.: Run this register second, as it's easier if no test user is present.
     * @depends testControllerConstructor
     * @see UserFrosting\Sprinkle\Account\Tests\Integration\RegistrationTest for complete registration exception (for example duplicate email) testing
     */
    /*public function testRegister()
    {
        // Force locale config
        $this->ci->config['site.registration.user_defaults.locale'] = 'en_US';
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
        ];

        // Create fake mailer
        $mailer = m::mock(Mailer::class);
        $mailer->shouldReceive('send')->once()->with(\Mockery::type(TwigMailMessage::class));
        $this->ci->mailer = $mailer;

        // Register will fail on PGSQL if a user is created with forced id
        // before registration occurs because the forced id mess the auto_increment
        // @see https://stackoverflow.com/questions/36157029/laravel-5-2-eloquent-save-auto-increment-pgsql-exception-on-same-id
        // So we create a dummy user and assign the master id config to it's id
        // to bypass the "no registration if no master user" security feature.
        // (Note the dummy should by default be id n°1, but we still assign the config
        // in case the default config does not return 1)
        $fm = $this->ci->factory;
        $dummyUser = $fm->create(User::class);
        $this->ci->config['reserved_user_ids.master'] = $dummyUser->id;

        // Recreate controller to use fake config
        $controller = $this->getController();

        // Perform common test code
        $this->performActualRegisterTest($controller);
    }*/

    /**
     * @depends testControllerConstructor
     * @depends testRegister
     */
    /*public function testRegisterWithNoEmailVerification()
    {
        // Delete previous attempt so we can reuse the same shared test code
        if ($user = User::where('email', 'testRegister@test.com')->first()) {
            $user->delete(true);
        }

        // Force locale config, disable email verification
        $this->ci->config['site.registration.require_email_verification'] = false;
        $this->ci->config['site.registration.user_defaults.locale'] = 'en_US';
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
        ];

        // Bypass security feature
        $fm = $this->ci->factory;
        $dummyUser = $fm->create(User::class);
        $this->ci->config['reserved_user_ids.master'] = $dummyUser->id;

        // Recreate controller to use fake config
        $controller = $this->getController();

        // Perform common test code
        $this->performActualRegisterTest($controller);
    }*/
}
