<?php

declare(strict_types=1);

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Listener;

use Exception;
use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\GroupInterface;
use UserFrosting\Sprinkle\Account\Event\UserCreatedEvent;
use UserFrosting\Support\Repository\Repository as Config;

class AssignDefaultGroups
{
    public function __construct(
        protected Config $config,
        protected GroupInterface $groupModel,
    ) {
    }

    public function __invoke(UserCreatedEvent $event): void
    {
        // TODO : Default group should be defined in the DB instead of config.
        // TODO : We need to accommodate "no group" too.
        $defaultGroupSlug = $this->config->get('site.registration.user_defaults.group');
        $defaultGroup = $this->groupModel->where('slug', $defaultGroupSlug)->first();

        if ($defaultGroupSlug == true && $defaultGroup === null) {
            $e = new Exception("Account registration is not working because the default group '{$defaultGroupSlug}' does not exist.");
            // $e->addUserMessage('ACCOUNT.REGISTRATION_BROKEN');

            throw $e;
        }

        $event->user->group()->associate($defaultGroup);
    }
}
