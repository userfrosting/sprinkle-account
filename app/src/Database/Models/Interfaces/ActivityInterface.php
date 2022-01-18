<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Activity Model Interface.
 */
interface ActivityInterface
{
    /**
     * Users which belong to this activity.
     *
     * @return UserInterface|BelongsTo
     */
    public function user();
}
