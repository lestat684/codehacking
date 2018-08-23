<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumnForUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
	        /**
	         * @var $table Illuminate\Database\Schema\Blueprint.
	         */
	        $table->integer('role_id')
		        ->unsigned()
		        ->nullable()
		        ->after('password');
	        $table->integer('is_active')
		        ->default(0)
		        ->after('role_id');
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
            $table->dropColumn(['role_id', 'is_active']);
        });
    }
}
