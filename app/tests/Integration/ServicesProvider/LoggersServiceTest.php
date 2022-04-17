<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\ServicesProvider;

use DI\Container;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use UserFrosting\Config\Config;
use UserFrosting\Sprinkle\Account\Log\AuthLogger;
use UserFrosting\Sprinkle\Account\ServicesProvider\LoggersService;
use UserFrosting\Sprinkle\Core\ServicesProvider\LoggersService as CoreLoggersService;
use UserFrosting\Testing\ContainerStub;

/**
 * Mock tests for Loggers service.
 * Check to see if service returns what it's supposed to return
 */
class LoggersServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected Container $ci;

    public function setUp(): void
    {
        parent::setUp();

        // Create container with provider to test
        $accountProvider = new LoggersService();
        $coreProvider = new CoreLoggersService();
        $definitions = array_merge($coreProvider->register(), $accountProvider->register());
        $this->ci = ContainerStub::create($definitions);

        // Set mock Config
        $locator = Mockery::mock(Config::class)
            ->shouldReceive('get')->with('logs.path')->once()->andReturn('logs://database.log')
            ->getMock();
        $this->ci->set(Config::class, $locator);
    }

    public function testAuthLogger(): void
    {
        $this->assertInstanceOf(Logger::class, $this->ci->get(AuthLogger::class));
        $this->assertInstanceOf(LoggerInterface::class, $this->ci->get(AuthLogger::class));
        $this->assertInstanceOf(AuthLogger::class, $this->ci->get(AuthLogger::class));
    }
}
