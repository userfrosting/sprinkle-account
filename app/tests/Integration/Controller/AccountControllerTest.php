<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Controller;

use Mockery as m;
use UserFrosting\Sprinkle\Account\Controller\AccountController;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Facades\Password;
use UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository;
use UserFrosting\Sprinkle\Account\Testing\withTestUser;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Mail\Mailer;
use UserFrosting\Sprinkle\Core\Mail\TwigMailMessage;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;
// use UserFrosting\Sprinkle\Core\Tests\withController;
use UserFrosting\Sprinkle\Core\Throttle\Throttler;
use UserFrosting\Support\Exception\ForbiddenException;
use UserFrosting\Support\Exception\NotFoundException;

/**
 * Tests AccountController
 */
class AccountControllerTest extends AccountTestCase
{
    use RefreshDatabase;
    use withTestUser;
    // use withController;

    /**
     * @var bool DB is initialized for normal db
     */
    protected static $initialized = false;

    /**
     * Setup test database for controller tests
     */
    /*public function setUp(): void
    {
        parent::setUp();
        // $this->setupTestDatabase();

        if ($this->usingInMemoryDatabase() || !static::$initialized) {

            // Setup database, then setup User & default role
            $this->refreshDatabase();
            static::$initialized = true;
        }
    }

    public function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }*/

    /**
     * @return AccountController
     */
    /*public function testControllerConstructor()
    {
        $controller = $this->getController();
        $this->assertInstanceOf(AccountController::class, $controller);

        return $controller;
    }*/

    /**
     * N.B.: Must be first test, before any master user is created
     * @depends testControllerConstructor
     * @param AccountController $controller
     */
    /*public function testRegisterWithNoMasterUser(AccountController $controller)
    {
        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'spiderbro' => 'http://',
        ]);

        $result = $controller->register($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 403);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }*/

    /**
     * @depends testControllerConstructor
     */
    /*public function testdenyResetPassword()
    {
        // Create fake PasswordResetRepository
        $repoPasswordReset = m::mock(PasswordResetRepository::class);
        $repoPasswordReset->shouldReceive('cancel')->once()->with('potato')->andReturn(true);
        $this->ci->repoPasswordReset = $repoPasswordReset;

        // Recreate controller to use fake PasswordResetRepository
        $controller = $this->getController();

        $request = $this->getRequest()->withQueryParams([
            'token' => 'potato',
        ]);

        $result = $controller->denyResetPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 302);
        $this->assertEquals($this->ci->router->pathFor('login'), $result->getHeaderLine('Location'));

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testdenyResetPassword
     */
    /*public function testdenyResetPasswordWithFailedPasswordReset()
    {
        // Create fake repoPasswordReset
        $repoPasswordReset = m::mock(PasswordResetRepository::class);
        $repoPasswordReset->shouldReceive('cancel')->once()->with('potato')->andReturn(false);
        $this->ci->repoPasswordReset = $repoPasswordReset;

        // Recreate controller to use fake throttler
        $controller = $this->getController();

        $request = $this->getRequest()->withQueryParams([
            'token' => 'potato',
        ]);

        $result = $controller->denyResetPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 302);
        $this->assertEquals($this->ci->router->pathFor('login'), $result->getHeaderLine('Location'));

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testdenyResetPassword
     * @param AccountController $controller
     */
    /*public function testdenyResetPasswordWithFailedValidation(AccountController $controller)
    {
        $result = $controller->denyResetPassword($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 302);
        $this->assertEquals($this->ci->router->pathFor('login'), $result->getHeaderLine('Location'));

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * N.B.: This test is incomplete as it doesn't actually check if
     *       repoPasswordReset returns the correct info and the message contains
     *       the right content
     * @depends testControllerConstructor
     */
    /*public function testforgotPassword()
    {
        // Create fake mailer
        $mailer = m::mock(Mailer::class);
        $mailer->shouldReceive('send')->once()->with(\Mockery::type(TwigMailMessage::class));
        $this->ci->mailer = $mailer;

        // Create fake user to test
        $user = $this->createTestUser(false, false, [
            'email' => 'foo@bar.com',
        ]);

        // Recreate controller to use fake mailer
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'email' => 'foo@bar.com',
        ]);

        $result = $controller->forgotPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testforgotPassword
     * @param AccountController $controller
     */
    /*public function testforgotPasswordWithFailedValidation(AccountController $controller)
    {
        $request = $this->getRequest()->withParsedBody([]);

        $result = $controller->forgotPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testforgotPassword
     */
    /*public function testforgotPasswordWithThrottler()
    {
        // Create fake throttler
        $throttler = m::mock(Throttler::class);
        $throttler->shouldReceive('getDelay')->once()->with('password_reset_request', ['email' => 'foo@bar.com'])->andReturn(90);
        $this->ci->throttler = $throttler;

        // Recreate controller to use fake throttler
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'email' => 'foo@bar.com',
        ]);

        $result = $controller->forgotPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 429);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @param AccountController $controller
     */
    /*public function testgetModalAccountTos(AccountController $controller)
    {
        $result = $controller->getModalAccountTos($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertNotSame('', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @param AccountController $controller
     */
    /*public function testpageForgotPassword(AccountController $controller)
    {
        $result = $controller->pageForgotPassword($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertNotSame('', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @param AccountController $controller
     */
    /*public function testpageRegister(AccountController $controller)
    {
        $result = $controller->pageRegister($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertNotSame('', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @depends testpageRegister
     */
    /*public function testpageRegisterWithDisabledRegistration()
    {
        // Force config
        $this->ci->config['site.registration.enabled'] = false;

        // Recreate controller to use new config
        $controller = $this->getController();

        $this->expectException(NotFoundException::class);
        $controller->pageRegister($this->getRequest(), $this->getResponse(), []);
    }

    /**
     * @depends testControllerConstructor
     * @depends testpageRegister
     */
    /*public function testpageRegisterWithNoLocales()
    {
        // Force config
        $this->ci->config['site.locales.available'] = [];

        // Recreate controller to use new config
        $controller = $this->getController();

        $result = $controller->pageRegister($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertNotSame('', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @depends testpageRegister
     */
    /*public function testpageRegisterWithLoggedInUser()
    {
        // Create a test user
        $testUser = $this->createTestUser(false, true);

        // Recreate controller to use fake throttler
        $controller = $this->getController();

        $result = $controller->pageRegister($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 302);
    }

    /**
     * @depends testControllerConstructor
     */
    /*public function testpageSettings()
    {
        // Create admin user. He will have access
        $testUser = $this->createTestUser(true, true);

        // Recreate controller to use user
        $controller = $this->getController();

        $this->actualpageSettings($controller);
    }

    /**
     * @depends testControllerConstructor
     * @depends testpageSettings
     */
    /*public function testpageSettingsWithPartialPermissions()
    {
        // Create a user and give him permissions
        $testUser = $this->createTestUser(false, true);
        $this->giveUserTestPermission($testUser, 'uri_account_settings');

        // Force config
        $this->ci->config['site.locales.available'] = [];

        // Recreate controller to use config & user
        $controller = $this->getController();

        $this->actualpageSettings($controller);
    }

    /**
     * @param AccountController $controller
     */
    protected function actualpageSettings(AccountController $controller)
    {
        $result = $controller->pageSettings($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertNotSame('', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @param AccountController $controller
     */
    /*public function testpageSettingsWithNoPermissions(AccountController $controller)
    {
        $this->expectException(ForbiddenException::class);
        $controller->pageSettings($this->getRequest(), $this->getResponse(), []);
    }

    /**
     * @depends testControllerConstructor
     * @param AccountController $controller
     */
    /*public function testpageSignIn(AccountController $controller)
    {
        $result = $controller->pageSignIn($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertNotSame('', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     * @depends testpageSignIn
     */
    /*public function testpageSignInWithLoggedInUser()
    {
        // Create a test user
        $testUser = $this->createTestUser(false, true);

        // Recreate controller to use fake throttler
        $controller = $this->getController();

        $result = $controller->pageSignIn($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 302);
    }

    /**
     * @depends testControllerConstructor
     */
    /*public function testProfile()
    {
        // Create admin user. He will have access
        $testUser = $this->createTestUser(true, true);

        // Force config
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
            'fr_FR' => true,
        ];

        // Recreate controller to use user
        $controller = $this->getController();

        $this->performActualProfileTests($controller, $testUser);
    }

    /**
     * @depends testControllerConstructor
     * @depends testProfile
     */
    /*public function testProfileWithPartialPermissions()
    {
        // Create a user and give him permissions
        $testUser = $this->createTestUser(false, true);
        $this->giveUserTestPermission($testUser, 'update_account_settings');

        // Force config
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
        ];

        // Recreate controller to use config & user
        $controller = $this->getController();

        $this->performActualProfileTests($controller, $testUser);
    }

    /**
     * @param AccountController $controller
     * @param UserInterface     $user
     */
    protected function performActualProfileTests(AccountController $controller, UserInterface $user)
    {
        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'first_name' => 'foo',
            //'last_name'  => 'bar', // don't change this one
            'locale'     => 'en_US',
        ]);

        $result = $controller->profile($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Make sure user was update
        $editedUser = User::where('user_name', $user->user_name)->first();
        $this->assertSame('foo', $editedUser->first_name);
        $this->assertSame($user->last_name, $editedUser->last_name);
        $this->assertSame($user->locale, $editedUser->locale);

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testProfile
     * @param AccountController $controller
     */
    /*public function testProfileWithNoPermissions(AccountController $controller)
    {
        $result = $controller->profile($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 403);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testProfile
     */
    /*public function testProfileWithFailedValidation()
    {
        // Create admin user. He will have access
        $testUser = $this->createTestUser(true, true);

        // Force config
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
            'fr_FR' => true,
        ];

        // Recreate controller to use user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([]);

        $result = $controller->profile($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testProfile
     */
    /*public function testProfileWithInvalidLocale()
    {
        // Create admin user. He will have access
        $user = $this->createTestUser(true, true);

        // Force config
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
            'fr_FR' => true,
        ];

        // Recreate controller to use user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'first_name' => 'foobarfoo',
            'locale'     => 'foobarfoo',
        ]);

        $result = $controller->profile($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Make sure user was NOT updated
        $editedUser = User::where('user_name', $user->user_name)->first();
        $this->assertNotSame('foobarfoo', $editedUser->first_name);
        $this->assertSame($user->first_name, $editedUser->first_name);
        $this->assertSame($user->last_name, $editedUser->last_name);
        $this->assertSame($user->locale, $editedUser->locale);

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     */
    /*public function testRegisterWithLoggedInUser()
    {
        // Create test user
        $user = $this->createTestUser(false, true);

        // Recreate controller to use user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'spiderbro' => 'http://',
        ]);

        $result = $controller->register($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 403);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     */
    /*public function testSetPassword()
    {
        // Create fake user to test
        $user = $this->createTestUser(false, true);

        // Create fake PasswordResetRepository
        $resetModel = $this->ci->repoPasswordReset->create($user, 9999);

        // Recreate controller to use fake PasswordResetRepository
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'password'  => 'testSetPassword',
            'passwordc' => 'testSetPassword',
            'token'     => $resetModel->getToken(),
        ]);

        $result = $controller->setPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSetPassword
     * @param AccountController $controller
     */
    /*public function testSetPasswordWithNoToken(AccountController $controller)
    {
        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'password'  => 'testSetPassword',
            'passwordc' => 'testSetPassword',
            'token'     => 'potato',
        ]);

        $result = $controller->setPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSetPassword
     * @param AccountController $controller
     */
    /*public function testsetPasswordWithFailedValidation(AccountController $controller)
    {
        // Set POST
        $request = $this->getRequest()->withParsedBody([]);

        $result = $controller->setPassword($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());
    }

    /**
     * @depends testControllerConstructor
     */
    /*public function testSettings()
    {
        // Create fake admin to test
        $user = $this->createTestUser(true, true);

        // Faker doesn't hash the password. Let's do that now
        $unhashed = $user->password;
        $user->password = Password::hash($user->password);
        $user->save();

        // Recreate controller to use fake user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'passwordcheck' => $unhashed,
            'email'         => 'testSettings@test.com',
            'password'      => 'testrSetPassword',
            'passwordc'     => 'testrSetPassword',
        ]);

        $result = $controller->settings($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSettings
     */
    /*public function testSettingsOnlyEmailNoLocale()
    {
        // Create fake admin to test
        $user = $this->createTestUser(true, true);

        // Faker doesn't hash the password. Let's do that now
        $unhashed = $user->password;
        $user->password = Password::hash($user->password);
        $user->save();

        // Force locale config
        $this->ci->config['site.registration.user_defaults.locale'] = 'en_US';
        $this->ci->config['site.locales.available'] = [
            'en_US' => true,
        ];

        // Recreate controller to use fake user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'passwordcheck' => $unhashed,
            'email'         => 'testSettings@test.com',
            'password'      => '',
            'passwordc'     => '',
        ]);

        $result = $controller->settings($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 200);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSettings
     */
    /*public function testSettingsWithNoPermissions()
    {
        // Create fake normal user to test
        $user = $this->createTestUser(false, true);

        // Recreate controller to use fake user
        $controller = $this->getController();

        $result = $controller->settings($this->getRequest(), $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 403);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSettings
     */
    /*public function testSettingsWithFailedValidation()
    {
        // Create fake normal user to test
        $user = $this->createTestUser(true, true);

        // Recreate controller to use fake user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([]);

        $result = $controller->settings($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSettings
     */
    /*public function testSettingsWithFailedPasswordCheck()
    {
        // Create fake admin to test
        $user = $this->createTestUser(true, true);

        // Faker doesn't hash the password. Let's do that now
        $unhashed = $user->password;
        $user->password = Password::hash($user->password);
        $user->save();

        // Recreate controller to use fake user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'passwordcheck' => 'foo',
            'email'         => 'testSettings@test.com',
            'password'      => 'testrSetPassword',
            'passwordc'     => 'testrSetPassword',
        ]);

        $result = $controller->settings($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @depends testControllerConstructor
     * @depends testSettings
     */
    /*public function testSettingsWithEmailInUse()
    {
        // Create user which will be the duplicate email
        $firstUser = $this->createTestUser();

        // Create fake admin to test
        $user = $this->createTestUser(true, true);

        // Recreate controller to use fake user
        $controller = $this->getController();

        // Set POST
        $request = $this->getRequest()->withParsedBody([
            'email'    => $firstUser->email,
            'password' => '',
        ]);

        $result = $controller->settings($request, $this->getResponse(), []);
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $result);
        $this->assertSame($result->getStatusCode(), 400);
        $this->assertJson((string) $result->getBody());
        $this->assertSame('[]', (string) $result->getBody());

        // Test message
        $ms = $this->ci->alerts;
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    /**
     * @return AccountController
     */
    protected function getController()
    {
        return new AccountController($this->ci);
    }
}
