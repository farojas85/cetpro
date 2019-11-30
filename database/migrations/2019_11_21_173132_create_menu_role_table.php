<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id')->index();
            $table->foreign('menu_id')->references('id')->on('menus')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('role_id')->index();
            $table->foreign('role_id')->references('id')->on('roles')
                    ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('menu_role');
    }
}
