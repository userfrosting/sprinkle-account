<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Event;

use Psr\EventDispatcher\StoppableEventInterface;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;

class UserRedirectedAfterLoginEvent implements StoppableEventInterface
{
    protected bool $stopped = false;

    /**
     * @param UserInterface $user
     */
    public function __construct(public UserInterface $user)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function isPropagationStopped() : bool
    {
        return $this->stopped;
    }

    /**
     * Stop event propagation.
     */
    public function stop(): void
    {
        $this->stopped = true;
    }
}
