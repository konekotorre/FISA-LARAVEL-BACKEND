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
            'id' => '1',
            'nombre' => 'CC',
            'descripcion' => 'Cédula de Ciudadania',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'id' => '2',
            'nombre' => 'TI',
            'descripcion' => 'Tarjeta de Identidad',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'id' => '3',
            'nombre' => 'RC',
            'descripcion' => 'Registro Civil',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'id' => '4',
            'nombre' => 'CE',
            'descripcion' => 'Cédula de Extranjería',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'id' => '5',
            'nombre' => 'PA',
            'descripcion' => 'Pasaporte',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'id' => '6',
            'nombre' => 'MS',
            'descripcion' => 'Menor Sin Identidad',
        ]);

        DB::table('tipo_documento_personas')->insert([
            'id' => '7',
            'nombre' => 'AS',
            'descripcion' => 'Adulto Sin Identidad',
        ]);
    }
}
