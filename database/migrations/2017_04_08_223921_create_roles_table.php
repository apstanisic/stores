<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {

        	$table->increments('id');
        	$table->string('name');
        	$table->timestamps();

        });

        // Schema::create('role_user', function(Blueprint $table) {

        //     $table->increments('id');

        //     $table->integer('role_id')->unsigned()->index();
        //     $table->foreign('role_id')->references('id')->on('roles');

        //     $table->integer('user_id')->unsigned()->index();
        //     $table->foreign('user_id')->references('id')->on('users');

        //     $table->unique(['role_id', 'user_id']);

        //     $table->timestamps();

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
