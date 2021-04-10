<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionFinancierasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_financieras', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->double('ingresos_anuales')->nullable();
            $table->double('egresos_anuales')->nullable();
            $table->double('ingresos_operacionales')->nullable();
            $table->double('egresos_operacionales')->nullable();
            $table->double('ingresos_no_operacionales')->nullable();
            $table->double('egresos_no_operacionales')->nullable();
            $table->double('ventas_anuales')->nullable();
            $table->double('total_activos')->nullable();
            $table->double('total_pasivos')->nullable();
            $table->double('patrimonio_total')->nullable();
            $table->integer('regimen_id')->nullable();
            $table->year('temporada_declaracion')->nullable();
            $table->integer('clasificacion_id')->nullable();
            $table->year('temporada_cuota')->nullable();
            $table->double('cuota_anual')->nullable();
            $table->double('cuota_real_pagada')->nullable();
            $table->double('cuota_sostenimiento_real_pagada')->nullable();
            $table->double('cuota_pautas')->nullable();
            $table->boolean('exporta')->nullable();
            $table->boolean('importa')->nullable();
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('regimen_id')->references('id')->on('regimens');
            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('clasificacion_id')->references('id')->on('clasificacions');
            $table->foreign('usuario_creacion')->references('id')->on('users');
            $table->foreign('usuario_actualizacion')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacion_financieras');
    }
}
