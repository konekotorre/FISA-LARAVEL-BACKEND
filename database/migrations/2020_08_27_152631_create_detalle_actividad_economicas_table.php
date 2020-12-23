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
            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->integer('ciiu_id');
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
