<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

use League\FactoryMuffin\Faker\Facade as Faker;
use UserFrosting\Sprinkle\Account\Database\Models\Permission;

/*
 * General factory for the Permission Model
 */
$fm->define(Permission::class)->setDefinitions([
    'name'        => Faker::word(),
    'description' => Faker::paragraph(),
    'conditions'  => Faker::word(),
    'slug'        => function ($object, $saved) {
        return uniqid();
    },
]);
