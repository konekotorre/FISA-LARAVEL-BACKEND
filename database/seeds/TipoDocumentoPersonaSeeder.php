<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'CC',
            'descripcion' => 'Cédula de Ciudadania',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'TI',
            'descripcion' => 'Tarjeta de Identidad',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'RC',
            'descripcion' => 'Registro Civil',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'CE',
            'descripcion' => 'Cédula de Extranjería',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'PA',
            'descripcion' => 'Pasaporte',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'MS',
            'descripcion' => 'Menor Sin Identidad',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'nombre' => 'AS',
            'descripcion' => 'Adulto Sin Identidad',
        ]);
    }
}
