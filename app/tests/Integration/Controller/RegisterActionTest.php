<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Controller;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use UserFrosting\Alert\AlertStream;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Mail\Mailer;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;
use UserFrosting\Sprinkle\Core\Throttle\Throttler;
use UserFrosting\Sprinkle\Core\Util\Captcha;
use UserFrosting\Support\Repository\Repository as Config;

/**
 * Tests RegisterAction
 */
class RegisterActionTest extends AccountTestCase
{
    use RefreshDatabase;
    use MockeryPHPUnitIntegration;

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
        $this->setRequireEmailVerification(false);

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

    public function testRegisterWithEmailVerification(): void
    {
        /** @var Mailer */
        $mailer = Mockery::mock(Mailer::class)
            ->makePartial()
            ->shouldReceive('send')->once()
            ->getMock();
        $this->ci->set(Mailer::class, $mailer);

        $this->setMasterUser();
        $captcha = $this->getCaptcha();
        $this->forceLocaleConfig();
        $this->setRequireEmailVerification(true);

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
    }

    public function testRegisterWithFailedThrottle(): void
    {
        // Create fake throttler
        $throttler = Mockery::mock(Throttler::class);
        $throttler->shouldReceive('getDelay')->once()->with('registration_attempt')->andReturn(90);
        $this->ci->set(Throttler::class, $throttler);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('POST', '/account/register', []);
        $response = $this->handleRequest($request);

        // Assert response status
        $this->assertResponseStatus(429, $response);
    }

    // TODO : Test with logedin user

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
     * Set require_email_verification config.
     *
     * @param bool $value
     */
    protected function setRequireEmailVerification(bool $value): void
    {
        /** @var Config */
        $config = $this->ci->get(Config::class);

        $config->set('site.registration.require_email_verification', $value);
    }
}
