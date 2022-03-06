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

class UserRedirectedAfterLoginEvent implements StoppableEventInterface
{
    protected bool $stopped = false;

    protected ?string $redirect = null;

    /**
     * {@inheritDoc}
     */
    public function isPropagationStopped(): bool
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

    /**
     * Get the value of redirect.
     *
     * @return string
     */
    public function getRedirect(): ?string
    {
        return $this->redirect;
    }

    /**
     * Set the value of redirect.
     *
     * @param string $redirect
     */
    public function setRedirect(?string $redirect): void
    {
        $this->redirect = $redirect;
    }
}
