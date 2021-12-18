<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAsignadoVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_asignado_visitas', function (Blueprint $table) {

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('asignado_id')->unsigned();
            $table->integer('visita_id')->unsigned();
            $table->timestamps();

            $table->foreign('asignado_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('visita_id')->references('id')->on('visitas');
            
        });

        Schema::table('detalle_asignado_visitas', function (Blueprint $table) {
            $table->foreign('visita_id')->references('id')->on('visitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_contacto_visitas');
    }
}
