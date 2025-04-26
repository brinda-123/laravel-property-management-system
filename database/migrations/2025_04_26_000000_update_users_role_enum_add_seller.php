<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateUsersRoleEnumAddSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the 'role' enum to add 'seller'
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'agent', 'user', 'seller') NOT NULL DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the 'role' enum to original values
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'agent', 'user') NOT NULL DEFAULT 'user'");
    }
}
