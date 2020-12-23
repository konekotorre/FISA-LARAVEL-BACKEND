<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exportaciones', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->integer('pais_id');
            $table->timestamps();

            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('pais_id')->references('id')->on('pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exportaciones');
    }
}
