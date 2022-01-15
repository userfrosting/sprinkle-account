<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

use League\FactoryMuffin\Faker\Facade as Faker;
use UserFrosting\Sprinkle\Account\Database\Models\Role;

/*
 * General factory for the Role Model
 */
$fm->define(Role::class)->setDefinitions([
    'name'        => Faker::word(),
    'description' => Faker::paragraph(),
    'slug'        => function ($object, $saved) {
        return uniqid();
    },
]);
