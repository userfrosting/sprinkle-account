<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Helpers;

use PHPUnit\Framework\TestCase;
use UserFrosting\Sprinkle\Account\Database\Models\Group;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Support\Exception\BadInstanceOfException;

class DynamicUserModelTest extends TestCase
{
    /**
     * User Model will be set by Service Provider
     */
    public function testSetGetUserModel(): void
    {
        $class = new StubClass();
        $class->setUserModel(User::class);
        $this->assertSame(User::class, $class->getUserModel());
    }

    public function testSetUserModelWithBadInstance(): void
    {
        $class = new StubClass();
        $this->expectException(BadInstanceOfException::class);
        $class->setUserModel(Group::class);
    }
}

class StubClass
{
    use DynamicUserModel;
}
