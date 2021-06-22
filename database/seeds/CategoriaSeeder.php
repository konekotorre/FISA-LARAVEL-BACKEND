<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'AFILIADO',
            'descripcion' => 'Son las organizaciones afiliadas',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'AMCHAM',
            'descripcion' => 'Son las organizaciones relacionadas con AMCHAM',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'CAMARAS INTERNACIONALES',
            'descripcion' => 'Son las camaras internacionales',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'CLUB',
            'descripcion' => 'Se compone de clubes',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'DESAFILIADO NO INVITAR SIN COSTO',
            'descripcion' => 'Desafiliado del sistema',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'EMPRESAS USA',
            'descripcion' => 'Organizacion perteneciente a Estados Unidos',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'GOBIERNO',
            'descripcion' => 'Organizaciones relacionadas al gobierno',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'GREMIOS NO AFILIADOS',
            'descripcion' => 'Son los gremios no afiliados',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'MEDIOS DE COMUNICACION',
            'descripcion' => 'Organizaciones de medios de comunicacion tradicionales y modernos',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'NO AFILIADO',
            'descripcion' => 'Organizaciones NO AFILIADAS',
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'POTENCIAL',
            'descripcion' => 'Organizaciones potenciales a futuro',
        ]);
    }
}
