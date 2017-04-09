<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('premission_role', function(Blueprint $table) {

    		$table->increments('id');

    		$table->integer('premission_id')->unsigned()->index();
    		$table->foreign('premission_id')->references('id')->on('premissions');

        	$table->integer('role_id')->unsigned()->index();
        	$table->foreign('role_id')->references('id')->on('roles');

        	$table->unique(['premission_id', 'role_id']);

        	$table->timestamps();

    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premission_role');
    }
}
