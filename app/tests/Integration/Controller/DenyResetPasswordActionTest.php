<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Controller;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use UserFrosting\Alert\AlertStream;
use UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;

class DenyResetPasswordActionTest extends AccountTestCase
{
    use MockeryPHPUnitIntegration;

    public function testDenyResetPassword(): void
    {
        // Mock PasswordResetRepository
        $repoPasswordReset = Mockery::mock(PasswordResetRepository::class)
            ->shouldReceive('cancel')->once()->with('potato')->andReturn(true)
            ->getMock();
        $this->ci->set(PasswordResetRepository::class, $repoPasswordReset);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('GET', '/account/set-password/deny')
            ->withQueryParams(['token' => 'potato']);
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertResponseStatus(302, $response);
        $this->assertSame('/account/login', $response->getHeaderLine('Location'));

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    public function testDenyResetPasswordWithFailedPasswordReset(): void
    {
        // Mock PasswordResetRepository
        $repoPasswordReset = Mockery::mock(PasswordResetRepository::class)
            ->shouldReceive('cancel')->once()->with('potato')->andReturn(false)
            ->getMock();
        $this->ci->set(PasswordResetRepository::class, $repoPasswordReset);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('GET', '/account/set-password/deny')
            ->withQueryParams(['token' => 'potato']);
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertResponseStatus(302, $response);
        $this->assertSame('/account/login', $response->getHeaderLine('Location'));

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    public function testDenyResetPasswordWithFailedValidation(): void
    {
        // Mock VerificationRepository
        $repoVerification = Mockery::mock(VerificationRepository::class)
            ->shouldNotReceive('cancel')
            ->getMock();
        $this->ci->set(VerificationRepository::class, $repoVerification);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('GET', '/account/set-password/deny');
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertResponseStatus(302, $response);
        $this->assertSame('/account/login', $response->getHeaderLine('Location'));

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }
}
