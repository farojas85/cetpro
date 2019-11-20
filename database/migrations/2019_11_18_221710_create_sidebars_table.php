<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidebarsTable extends Migration
{
    public function up()
    {
        Schema::create('sidebars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('clase');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sidebars');
    }
}
