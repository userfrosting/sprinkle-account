<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Database\Migrations\v430;

use Illuminate\Database\Schema\Blueprint;
use UserFrosting\Sprinkle\Core\Database\Migration;

/**
 * Groups table migration
 * Changes the `icon` column property of `default` to NULL to align with new Font Awesome 5 tag convention.
 * Version 4.3.0.
 *
 * See https://laravel.com/docs/5.4/migrations#tables
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class UpdateGroupsTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public static $dependencies = [
        '\UserFrosting\Sprinkle\Account\Database\Migrations\v400\GroupsTable',
    ];

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        if ($this->schema->hasTable('groups')) {
            $this->schema->table('groups', function (Blueprint $table) {
                $table->string('icon', 100)->nullable()->change();
            });
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->table('groups', function (Blueprint $table) {
            $table->string('icon', 100)->default('fa fa-user')->nullable(false)->change();
        });
    }
}
