<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Database\Models;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Testing\withTestUser;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;
use UserFrosting\Support\Repository\Repository as Config;

/**
 * UserTest Class. Tests the User Model.
 */
class UserTest extends AccountTestCase
{
    use MockeryPHPUnitIntegration;
    use RefreshDatabase;

    /**
     * Setup the database schema.
     */
    public function setUp(): void
    {
        parent::setUp();

        // Setup test database
        $this->refreshDatabase();
    }

    public function testUser(): void
    {
        // Assert Initial DB state
        $this->assertSame(0, User::count());

        $user = new User([
            'user_name'  => 'testing',
            'email'      => 'test@test.test',
            'first_name' => 'Test',
            'last_name'  => 'Ing',
            'password'   => '', // TODO Hash in model
        ]);
        $user->save();
        $this->assertInstanceOf(UserInterface::class, $user); // @phpstan-ignore-line

        // Assert new state
        $this->assertSame(1, User::count());

        // Get User and assert it's properties
        /** @var User */
        $fetchedUser = User::find($user->id);
        $this->assertSame('testing', $fetchedUser->user_name);
        $this->assertSame('test@test.test', $fetchedUser->email);
        $this->assertSame('Test', $fetchedUser->first_name);
        $this->assertSame('Ing', $fetchedUser->last_name);
        $this->assertSame('Test Ing', $fetchedUser->full_name);
        $this->assertIsString($fetchedUser->password); // @phpstan-ignore-line
        $this->assertIsString($fetchedUser->locale); // @phpstan-ignore-line
        $this->assertIsBool($fetchedUser->flag_verified); // @phpstan-ignore-line
        $this->assertIsBool($fetchedUser->flag_enabled); // @phpstan-ignore-line

        // Delete
        $fetchedUser->delete();

        // Assert new state
        $this->assertSame(0, User::count());

        // Assert soft delete
        $this->assertSame(1, User::withTrashed()->count());
    }

    public function testUserIsMaster(): void
    {
        /** @var User */
        $masterUser = User::factory()->create();

        /** @var User */
        $normalUser = User::factory()->create();

        $config = Mockery::mock(Config::class)
            ->shouldReceive('get')->with('reserved_user_ids.master')->times(2)->andReturn($masterUser->id)
            ->getMock();
        $this->ci->set(Config::class, $config);

        $this->assertTrue($masterUser->isMaster());
        $this->assertFalse($normalUser->isMaster());
    }

    public function testUserAvatar(): void
    {
        /** @var User */
        $user = User::factory()->make();

        $this->assertIsString($user->avatar); // @phpstan-ignore-line
        $this->assertStringContainsString('gravatar', $user->avatar);
    }

    /**
     * Test user hard deletion.
     */
    public function testUserForceDelete(): void
    {
        /** @var User */
        $user = User::factory()->create();

        $this->assertSame(1, User::withTrashed()->count());
        $this->assertTrue($user->forceDelete());
        $this->assertSame(0, User::withTrashed()->count());
    }
}
