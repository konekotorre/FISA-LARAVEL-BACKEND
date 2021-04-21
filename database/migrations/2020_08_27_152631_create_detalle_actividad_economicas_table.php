<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleActividadEconomicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_actividad_economicas', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->integer('ciiu_id')->unsigned();
            $table->timestamps();

            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('ciiu_id')->references('id')->on('ciius');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_actividad_economicas');
    }
}
