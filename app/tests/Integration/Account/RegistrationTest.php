<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Account;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;
use UserFrosting\Sprinkle\Account\Account\Registration;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;

/**
 * Tests the Registration class.
 */
class RegistrationTest extends AccountTestCase
{
    use RefreshDatabase;
    use MockeryPHPUnitIntegration;

    /**
     * @var array<string, string> Test user data
     */
    protected array $fakeUserData = [
        'user_name'     => 'FooBar',
        'first_name'    => 'Foo',
        'last_name'     => 'Bar',
        'email'         => 'Foo@Bar.com',
        'password'      => 'FooBarFooBar123',
    ];

    /**
     * Setup the database schema.
     */
    public function setUp(): void
    {
        parent::setUp();

        // Setup test database
        $this->refreshDatabase();
    }

    /**
     * @depends testValidation
     */
    /*public function testNormalRegistration()
    {
        // userActivityLogger will receive something, but won't be able to handle it since there's no session. So we mock it
        $this->ci->userActivityLogger = m::mock('\Monolog\Logger');
        $this->ci->userActivityLogger->shouldReceive('info')->once();

        // Tests can't mail properly
        $this->ci->config['site.registration.require_email_verification'] = false;

        // Get class
        $registration = new Registration($this->ci, $this->fakeUserData);
        $this->assertInstanceOf(Registration::class, $registration);

        // Register user
        $user = $registration->register();

        // Registration should return a valid user, with a new ID
        $this->assertInstanceOf(UserInterface::class, $user);
        $this->assertEquals('FooBar', $user->user_name);
        $this->assertIsInt($user->id);

        // Make sure the user is added to the db by querying it
        $users = User::where('email', 'Foo@Bar.com')->get();
        $this->assertCount(1, $users);
        $this->assertSame('FooBar', $users->first()['user_name']);
    }*/
}
