<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('navbar_id')->default(16);
            $table->foreign('navbar_id')->references('id')->on('navbars')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sidebar_id')->default(1);
            $table->foreign('sidebar_id')->references('id')->on('sidebars')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('brandlogo_id')->default(11);
            $table->foreign('brandlogo_id')->references('id')->on('brandlogos')
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
        Schema::dropIfExists('theme_users');
    }
}
