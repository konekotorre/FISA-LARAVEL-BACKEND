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

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->double('ingresos_anuales', 15, 2)->nullable()->unsigned();
            $table->double('egresos_anuales', 15, 2)->nullable()->unsigned();
            $table->double('ingresos_operacionales', 15, 2)->nullable()->unsigned();
            $table->double('egresos_operacionales', 15, 2)->nullable()->unsigned();
            $table->double('ingresos_no_operacionales', 15, 2)->nullable()->unsigned();
            $table->double('egresos_no_operacionales', 15, 2)->nullable()->unsigned();
            $table->double('ventas_anuales', 15, 2)->nullable()->unsigned();
            $table->double('total_activos', 15, 2)->nullable()->unsigned();
            $table->double('total_pasivos', 15, 2)->nullable()->unsigned();
            $table->double('patrimonio_total', 15, 2)->nullable()->unsigned();
            $table->integer('regimen_id')->nullable()->unsigned();
            $table->year('temporada_declaracion', 4)->nullable()->unsigned();
            $table->integer('clasificacion_id')->nullable()->unsigned();
            $table->double('cuota_real_pagada', 15, 2)->nullable()->unsigned();
            $table->double('cuota_unica_ingreso', 15, 2)->nullable()->unsigned();
            $table->double('cuota_pautas', 15, 2)->nullable()->unsigned();
            $table->date('fecha_edicion_pauta')->nullable();
            $table->double('pendiente_facturacion', 15, 2)->nullable()->unsigned();
            $table->string('exporta', 1)->nullable()->unsigned();
            $table->string('importa', 1)->nullable();
            $table->integer('usuario_creacion')->unsigned();
            $table->integer('usuario_actualizacion')->unsigned();
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
