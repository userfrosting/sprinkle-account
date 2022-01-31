<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Validators;

use UserFrosting\Sprinkle\Account\Account\Registration;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Exceptions\EmailNotUniqueException;
use UserFrosting\Sprinkle\Account\Exceptions\MissingRequiredParamException;
use UserFrosting\Sprinkle\Account\Exceptions\UsernameNotUniqueException;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Account\Validators\UserValidation;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;

/**
 * Tests the Registration class.
 */
class UserVerificationTest extends AccountTestCase
{
    use RefreshDatabase;

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

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    public function testValidation(): void
    {
        /** @var UserValidation */
        $validator = $this->ci->get(UserValidation::class);
        $user = new User($this->fakeUserData);
        $validation = $validator->validate($user);
        $this->assertTrue($validation);
    }

    public function testMissingFields(): void
    {
        // Remove `first_name` to simulate missing element.
        $data = $this->fakeUserData;
        unset($data['first_name']);
        $user = new User($data);

        /** @var UserValidation */
        $validator = $this->ci->get(UserValidation::class);

        $this->expectException(MissingRequiredParamException::class);
        // $this->expectExceptionMessage("Account can't be registered as 'first_name' is required to create a new user.");
        $validator->validate($user);
    }

    public function testValidationWithDuplicateUsername(): void
    {
        /** @var User */
        $existingUser = User::factory()->create();

        // Replace `username` to simulate duplicate.
        $data = $this->fakeUserData;
        $data['user_name'] = $existingUser->user_name;
        $user = new User($data);

        /** @var UserValidation */
        $validator = $this->ci->get(UserValidation::class);

        $this->expectException(UsernameNotUniqueException::class);
        // $this->expectExceptionMessage('Username is already in use.');
        $validator->validate($user);
    }

    public function testValidationWithDuplicateEmail(): void
    {
        /** @var User */
        $existingUser = User::factory()->create();

        // Replace `username` to simulate duplicate.
        $data = $this->fakeUserData;
        $data['email'] = $existingUser->email;
        $user = new User($data);

        /** @var UserValidation */
        $validator = $this->ci->get(UserValidation::class);

        $this->expectException(EmailNotUniqueException::class);
        // $this->expectExceptionMessage('Username is already in use.');
        $validator->validate($user);
    }

    public function testSetterGetters(): void
    {
        /** @var UserValidation */
        $validator = $this->ci->get(UserValidation::class);

        $result = $validator->setRequiredProperties([])->getRequiredProperties();
        $this->assertSame([], $result);

        $result = $validator->addRequiredProperty('foo')->getRequiredProperties();
        $this->assertSame(['foo'], $result);
    }
}
