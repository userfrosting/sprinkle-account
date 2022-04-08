<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Controller;

use Psr\EventDispatcher\EventDispatcherInterface;
use UserFrosting\Sprinkle\Account\Tests\AccountTestCase;
use UserFrosting\Sprinkle\Core\Bakery\Event\BakeCommandEvent;

class BakeCommandListenerTest extends AccountTestCase
{
    public function testListener(): void
    {
        /** @var \UserFrosting\Event\EventDispatcher */
        $eventDispatcher = $this->ci->get(EventDispatcherInterface::class);

        $event = new BakeCommandEvent([]);
        $event = $eventDispatcher->dispatch($event);

        $this->assertSame(['create-admin'], $event->getCommands());
    }
}
