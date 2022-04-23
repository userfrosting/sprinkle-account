<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Tests\Integration\Exceptions;

use PHPUnit\Framework\TestCase;
use UserFrosting\Sprinkle\Account\Exceptions\AccountException;

/**
 * Tests AccountException
 */
class AccountExceptionTest extends TestCase
{
    public function testEvent(): void
    {
        $e = new AccountException();

        $this->assertSame('foo', $e->setTitle('foo')->getTitle());
        $this->assertSame('bar', $e->setDescription('bar')->getDescription());
        $this->assertSame('pages/error/auth.html.twig', $e->getTemplate());
    }
}
