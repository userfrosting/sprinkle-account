<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Log;

use LogicException;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\ActivityInterface;

/**
 * Monolog handler for storing user activities to the database.
 *
 * @phpstan-import-type Level from \Monolog\Logger
 * @phpstan-import-type LevelName from \Monolog\Logger
 */
class UserActivityDatabaseHandler extends AbstractProcessingHandler
{
    /**
     * @var ActivityInterface
     */
    protected ActivityInterface $model;

    /**
     * Create a new DatabaseHandler object.
     *
     * @param ActivityInterface $model
     * @param int|string        $level  The minimum logging level at which this handler will be triggered
     * @param bool              $bubble Whether the messages that are handled can bubble up the stack or not
     *
     * @phpstan-param Level|LevelName|\Psr\Log\LogLevel::* $level
     */
    public function __construct(
        ActivityInterface $model,
        $level = Logger::DEBUG,
        $bubble = true
    ) {
        $this->model = $model;
        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record): void
    {
        if (!isset($record['context']['user_id'])) {
            throw new LogicException('UserActivityLogger requires a `user_id` to be set in the context.');
        }

        $log = new $this->model([
            'ip_address'  => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null,
            'user_id'     => $record['context']['user_id'],
            'type'        => $record['context']['type'] ?? 'undefined',
            'occurred_at' => $record['datetime'],
            'description' => $record['message'],
        ]);
        $log->save();
    }
}
