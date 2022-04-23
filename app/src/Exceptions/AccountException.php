<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Exceptions;

use Exception;
use Throwable;
use UserFrosting\Sprinkle\Core\Exceptions\Contracts\TwigRenderedException;
use UserFrosting\Sprinkle\Core\Exceptions\Contracts\UserMessageException;
use UserFrosting\Support\Message\UserMessage;

/**
 * Base exception for Auth related Exception.
 */
class AccountException extends Exception implements TwigRenderedException, UserMessageException
{
    protected string $title = 'ACCOUNT.EXCEPTION.TITLE';
    protected string|UserMessage $description = 'ACCOUNT.EXCEPTION.DESCRIPTION';
    protected string $twigTemplate = 'pages/error/auth.html.twig';
    protected int $httpCode = 400; // Force all AuthException to 400 code.

    /**
     * {@inheritDoc}
     */
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $code = ($code === 0) ? $this->httpCode : $code;

        parent::__construct($message, $code, $previous);
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate(): string
    {
        return $this->twigTemplate;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string|UserMessage
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     * @return static
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string|UserMessage
    {
        return $this->description;
    }

    /**
     * Set the value of description.
     *
     * @return static
     */
    public function setDescription(string|UserMessage $description): static
    {
        $this->description = $description;

        return $this;
    }
}
