<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Exceptions;

use UserFrosting\Support\Message\UserMessage;

/**
 * Used when an the username is not unique.
 */
final class EmailNotUniqueException extends AccountException
{
    protected string $title = 'EMAIL.INVALID';
    protected string $description = 'EMAIL.IN_USE';
    protected string $email = '';

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string|UserMessage
    {
        return new UserMessage($this->description, ['email' => $this->email]);
    }

    /**
     * Set the value of email.
     *
     * @param string $email
     *
     * @return static
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
