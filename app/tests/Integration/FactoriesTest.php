<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration;

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;

/**
 * FactoriesTest class.
 * Tests the factories defined in this sprinkle are working
 */
class FactoriesTest extends AccountTestCase
{
    use RefreshDatabase;

    /**
     * Test the user factory
     */
    /*public function testUserFactory()
    {
        // Setup test database
        // $this->setupTestDatabase();
        $this->refreshDatabase();

        $fm = $this->ci->factory;

        $user = $fm->create(User::class);
        $this->assertInstanceOf(UserInterface::class, $user);
    }*/
}
