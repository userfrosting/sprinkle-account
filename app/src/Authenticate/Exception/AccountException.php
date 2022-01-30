<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Authenticate\Exception;

use Exception;
use Throwable;
use UserFrosting\Sprinkle\Core\Exceptions\Contracts\TwigRenderedException;
use UserFrosting\Sprinkle\Core\Exceptions\Contracts\UserMessageException;

/**
 * Base exception for Auth related Exception.
 */
class AccountException extends Exception implements TwigRenderedException, UserMessageException
{
    protected string $title = 'ACCOUNT.EXCEPTION.TITLE';
    protected string $description = 'ACCOUNT.EXCEPTION.DESCRIPTION';
    protected string $twigTemplate = 'pages/error/auth.html.twig';

    /**
     * {@inheritDoc}
     */
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        // Force all AuthException to 403 code.
        $code = 403;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
