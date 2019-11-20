<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandlogosTable extends Migration
{
    public function up()
    {
        Schema::create('brandlogos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('clase');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('brandlogos');
    }
}
