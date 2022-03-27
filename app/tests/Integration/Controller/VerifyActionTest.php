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
use UserFrosting\Sprinkle\Account\Account;
use UserFrosting\Sprinkle\Account\Event\UserRedirectedAfterVerificationEvent;
use UserFrosting\Sprinkle\Account\Repository\VerificationRepository;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;

class VerifyActionTest extends AccountTestCase
{
    use MockeryPHPUnitIntegration;

    protected string $mainSprinkle = VerifyActionSprinkle::class;

    public function testVerify(): void
    {
        // Mock VerificationRepository
        $repoVerification = Mockery::mock(VerificationRepository::class)
            ->shouldReceive('complete')->once()->with('potato')->andReturn(true)
            ->getMock();
        $this->ci->set(VerificationRepository::class, $repoVerification);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('GET', '/account/verify')
            ->withQueryParams(['token' => 'potato']);
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([], $response);
        $this->assertResponseStatus(200, $response);

        // Assert Event Redirect
        $this->assertSame('/home', $response->getHeaderLine('UF-Redirect'));

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('success', end($messages)['type']);
    }

    public function testVerifyWithFailedVerification(): void
    {
        // Mock VerificationRepository
        $repoVerification = Mockery::mock(VerificationRepository::class)
            ->shouldReceive('complete')->once()->with('potato')->andReturn(false)
            ->getMock();
        $this->ci->set(VerificationRepository::class, $repoVerification);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('GET', '/account/verify')
            ->withQueryParams(['token' => 'potato']);
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([], $response);
        $this->assertResponseStatus(200, $response);

        // Assert Event Redirect
        $this->assertSame('/home', $response->getHeaderLine('UF-Redirect'));

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }

    public function testVerifyWithFailedValidation(): void
    {
        // Mock VerificationRepository
        $repoVerification = Mockery::mock(VerificationRepository::class)
            ->shouldNotReceive('complete')
            ->getMock();
        $this->ci->set(VerificationRepository::class, $repoVerification);

        // Create request with method and url and fetch response
        $request = $this->createJsonRequest('GET', '/account/verify');
        $response = $this->handleRequest($request);

        // Assert response status & body
        $this->assertJsonResponse([], $response);
        $this->assertResponseStatus(200, $response);

        // Assert Event Redirect
        $this->assertSame('/home', $response->getHeaderLine('UF-Redirect'));

        // Test message
        /** @var AlertStream */
        $ms = $this->ci->get(AlertStream::class);
        $messages = $ms->getAndClearMessages();
        $this->assertSame('danger', end($messages)['type']);
    }
}

class VerifyActionSprinkle extends Account
{
    /**
     * {@inheritDoc}
     */
    public function getEventListeners(): array
    {
        return [
            UserRedirectedAfterVerificationEvent::class => [
                UserRedirectedAfterVerificationListener::class,
            ],
        ];
    }
}

class UserRedirectedAfterVerificationListener
{
    public function __invoke(UserRedirectedAfterVerificationEvent $event): void
    {
        $event->setRedirect('/home');
        $event->stop();
    }
}
