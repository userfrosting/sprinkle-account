<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration;

use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Testing\withTestUser;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;

/**
 * UserModelTest Class
 * Tests the User Model.
 */
class UserModelTest extends AccountTestCase
{
    use RefreshDatabase;
    use withTestUser;

    /**
     * Setup the database schema.
     */
    public function setUp(): void
    {
        parent::setUp();

        // Setup test database
        // $this->setupTestDatabase();
        $this->refreshDatabase();
    }

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
