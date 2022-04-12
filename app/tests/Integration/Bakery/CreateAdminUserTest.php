<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Controller;

use Illuminate\Database\Connection;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PDOException;
use Psr\EventDispatcher\EventDispatcherInterface;
use UserFrosting\Event\EventDispatcher;
use UserFrosting\Sprinkle\Account\Bakery\CreateAdminUser;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Event\UserCreatedEvent;
use UserFrosting\Sprinkle\Account\Exceptions\UsernameNotUniqueException;
use UserFrosting\Sprinkle\Account\Log\UserActivityLogger;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Account\Validators\UserValidation;
use UserFrosting\Sprinkle\Core\Database\Migrator\MigrationRepositoryInterface;
use UserFrosting\Sprinkle\Core\Testing\RefreshDatabase;
use UserFrosting\Testing\BakeryTester;

class CreateAdminUserTest extends AccountTestCase
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

    public function testCommandWithUserInput(): void
    {
        // Asset initial user count.
        $this->assertEquals(0, User::count());

        // Mock eventDispatcher to assert it's being called properly.
        $eventDispatcher = Mockery::mock(EventDispatcherInterface::class)
            ->shouldReceive('dispatch')->with(Mockery::type(UserCreatedEvent::class))->once()->andReturnUsing(function ($arg1) {
                return $arg1;
            })
            ->getMock();
        $this->ci->set(EventDispatcher::class, $eventDispatcher);

        // Mock userActivityLogger to assert it's being called properly.
        $userActivityLogger = Mockery::mock(UserActivityLogger::class)
            ->shouldReceive('info')->once()
            ->getMock();
        $this->ci->set(UserActivityLogger::class, $userActivityLogger);

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command, userInput: [
            'test', // username
            'password123', // password
            'password123', // confirmation
            'test@test.com', // email
            'Test', // First name
            'ing', // Last name
        ]);
        $this->assertSame(0, $result->getStatusCode());

        // Assert that the user was created.
        $this->assertSame(1, User::count());
    }

    public function testCommandWithInput(): void
    {
        // Asset initial user count.
        $this->assertEquals(0, User::count());

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command, input: [
            '--username'  => 'test',
            '--password'  => 'password123',
            '--email'     => 'test@test.com',
            '--firstName' => 'Test',
            '--lastName'  => 'ing',
        ]);
        $this->assertSame(0, $result->getStatusCode());

        // Assert that the user was created.
        $this->assertSame(1, User::count());
    }

    public function testCommandWithUserInputRepeatedForEmpty(): void
    {
        // Asset initial user count.
        $this->assertEquals(0, User::count());

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command, userInput: [
            '', // username
            'test', // username repeated
            'password123', // password
            'password123', // confirmation
            'test@test.com', // email
            'Test', // First name
            'ing', // Last name
        ]);
        $this->assertSame(0, $result->getStatusCode());

        // Assert that the user was created.
        $this->assertSame(1, User::count());
    }

    public function testForFailedDbConnection(): void
    {
        // Mock Connection
        $connection = Mockery::mock(Connection::class)
            ->shouldReceive('getPdo')->once()->andThrow(new PDOException())
            ->shouldReceive('getName')->once()->andReturn('test')
            ->getMock();
        $this->ci->set(Connection::class, $connection);

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command);
        $this->assertSame(1, $result->getStatusCode());
        $this->assertStringContainsString('Could not connect to the database', $result->getDisplay());
    }

    public function testForNonExistingRepository(): void
    {
        // Mock MigrationRepositoryInterface
        $repository = Mockery::mock(MigrationRepositoryInterface::class)
            ->shouldReceive('exists')->once()->andReturn(false)
            ->getMock();
        $this->ci->set(MigrationRepositoryInterface::class, $repository);

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command);
        $this->assertSame(1, $result->getStatusCode());
        $this->assertStringContainsString("Migrations doesn't appear to have been run!", $result->getDisplay());
    }

    public function testForMissingDependencies(): void
    {
        // Mock MigrationRepositoryInterface
        $repository = Mockery::mock(MigrationRepositoryInterface::class)
            ->shouldReceive('exists')->once()->andReturn(true)
            ->shouldReceive('has')->once()->andReturn(false)
            ->getMock();
        $this->ci->set(MigrationRepositoryInterface::class, $repository);

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command);
        $this->assertSame(1, $result->getStatusCode());
    }

    public function testForExistingUser(): void
    {
        User::factory()->create();
        $this->assertEquals(1, User::count());

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command);
        $this->assertSame(0, $result->getStatusCode());
        $this->assertStringContainsString("Table 'users' is not empty.", $result->getDisplay());
    }

    public function testForFailedValidation(): void
    {
        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command, userInput: [
            'test', // username
            'password123', // password
            'password123', // confirmation
            'test', // email (invalid)
            'Test', // First name
            'ing', // Last name
        ]);
        $this->assertSame(1, $result->getStatusCode());
        $this->assertStringContainsString('Invalid email address.', $result->getDisplay());
    }

    public function testForFailedUserValidation(): void
    {
        // Mock UserValidation
        $validator = Mockery::mock(UserValidation::class)
            ->shouldReceive('validate')->once()->andThrow(new UsernameNotUniqueException())
            ->getMock();
        $this->ci->set(UserValidation::class, $validator);

        /** @var CreateAdminUser */
        $command = $this->ci->get(CreateAdminUser::class);
        $result = BakeryTester::runCommand($command, userInput: [
            'test', // username
            'password123', // password
            'password123', // confirmation
            'test@test.com', // email
            'Test', // First name
            'ing', // Last name
        ]);
        $this->assertSame(1, $result->getStatusCode());
        $this->assertStringContainsString('Invalid username', $result->getDisplay());
    }
}
