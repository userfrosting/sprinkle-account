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
use UserFrosting\Sprinkle\Account\Database\Models\Persistence;
use UserFrosting\Sprinkle\Account\Database\Models\Role;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Database\Models\Verification;
use UserFrosting\Sprinkle\Account\Testing\withTestUser;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;
use UserFrosting\Support\Repository\Repository as Config;

/**
 * UserModelTest Class
 * Tests the User Model.
 */
class UserModelTest extends AccountTestCase
{
    use MockeryPHPUnitIntegration;
    use RefreshDatabase;
    // use withTestUser;

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
    }

    public function testUserIsMaster(): void
    {
        /** @var User */
        $masterUser = User::factory()->make();
        $masterUser->save();

        /** @var User */
        $normalUser = User::factory()->make();
        $normalUser->save();

        $config = Mockery::mock(Config::class)
            ->shouldReceive('get')->with('reserved_user_ids.master')->times(2)->andReturn($masterUser->id)
            ->getMock();
        $this->ci->set(Config::class, $config);

        $this->assertTrue($masterUser->isMaster());
        $this->assertFalse($normalUser->isMaster());
    }

    /**
     * Test user hard deletion with user relations.
     * This is not a totally accurate test, as each relations are added manually
     * and new relations might not be added automatically to accurately test
     */
    /*public function testUserHardDeleteWithUserRelations()
    {
        $fm = $this->ci->factory;

        // Create a user & make sure it exist
        $user = $this->createTestUser();
        $this->assertInstanceOf(User::class, User::withTrashed()->find($user->id));

        //$user->activities - activities
        $this->ci->userActivityLogger->info('test', [
            'type'    => 'group_create',
            'user_id' => $user->id,
        ]);
        $this->assertSame(1, $user->activities()->count());

        //$user->passwordResets - password_resets
        $this->ci->repoPasswordReset->create($user, $this->ci->config['password_reset.timeouts.reset']);
        $this->assertSame(1, $user->passwordResets()->count());

        //{no relations} - persistences
        $persistence = new Persistence([
            'user_id'          => $user->id,
            'token'            => '',
            'persistent_token' => '',
            'expires_at'       => null,
        ]);
        $persistence->save();
        $this->assertSame(1, Persistence::where('user_id', $user->id)->count());

        //$user->roles - role_users
        $role = $fm->create(Role::class);
        $user->roles()->attach($role->id);
        $this->assertSame(1, $user->roles()->count());

        //{no relations} - verification
        $this->ci->repoVerification->create($user, $this->ci->config['verification.timeout']);
        $this->assertSame(1, $this->ci->classMapper->staticMethod('verification', 'where', 'user_id', $user->id)->count());

        // Force delete. Now user can't be found at all
        $this->assertTrue($user->delete(true));
        $this->assertNull(User::withTrashed()->find($user->id));

        // Assert deletions worked
        $this->assertSame(0, $user->activities()->count());
        $this->assertSame(0, $user->passwordResets()->count());
        $this->assertSame(0, $user->roles()->count());
        $this->assertSame(0, Persistence::where('user_id', $user->id)->count());
        $this->assertSame(0, $this->ci->classMapper->staticMethod('verification', 'where', 'user_id', $user->id)->count());
    }*/

    /**
     * Test user soft deletion.
     */
    /*public function testUserSoftDelete()
    {
        // Create a user & make sure it exist
        $user = $this->createTestUser();
        $this->assertInstanceOf(User::class, User::withTrashed()->find($user->id));

        // Soft Delete. User won't be found using normal query, but will withTrash
        $this->assertTrue($user->delete());
        $this->assertNull(User::find($user->id));
        $this->assertInstanceOf(User::class, User::withTrashed()->find($user->id));
    }

    /**
     * Test user hard deletion.
     */
    /*public function testUserHardDelete()
    {
        // Create a user & make sure it exist
        $user = $this->createTestUser();
        $this->assertInstanceOf(User::class, User::withTrashed()->find($user->id));

        // Force delete. Now user can't be found at all
        $this->assertTrue($user->delete(true));
        $this->assertNull(User::withTrashed()->find($user->id));
    }*/
}
