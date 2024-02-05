<?php

// database/migrations/2022_01_01_000000_add_columns_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add 'is_active' column
            $table->boolean('is_active')->default(true);

            // Add 'username' column
            $table->string('username')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes (if needed)
            $table->dropColumn('is_active');
            $table->dropColumn('username');
        });
    }
}
