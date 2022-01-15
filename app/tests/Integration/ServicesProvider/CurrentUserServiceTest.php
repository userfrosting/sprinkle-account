<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\ServicesProvider;

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Testing\withTestUser;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;

/**
 * Integration tests for `currentUser` service.
 * Check to see if service returns what it's supposed to return
 */
class CurrentUserServiceTest extends AccountTestCase
{
    use RefreshDatabase;
    use withTestUser;

    // public function testServiceWithNoUser()
    // {
    //     $this->assertNull($this->ci->currentUser);
    // }

    // public function testService()
    // {
    //     // $this->setupTestDatabase();
    //     $this->refreshDatabase();

    //     $testUser = $this->createTestUser(false, true);

    //     $this->assertInstanceOf(UserInterface::class, $this->ci->currentUser);
    // }
}
