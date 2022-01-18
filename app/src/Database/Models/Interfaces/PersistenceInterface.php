<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

/**
 * Persistence db Model Interface.
 *
 * @mixin \Illuminate\Database\Query\Builder
 */
interface PersistenceInterface
{
    /**
     * Relation with the user table.
     *
     * @return UserInterface|HasOne
     */
    public function user();
}
