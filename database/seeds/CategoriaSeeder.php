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
        // Seed Categories

        DB::table('categorias')->insert([
            'id' => '1',
            'nombre' => 'AFILIADO',
            'descripcion' => 'Son las organizaciones afiliadas',
        ]);

        DB::table('categorias')->insert([
            'id' => '2',
            'nombre' => 'AMCHAM',
            'descripcion' => 'Son las organizaciones relacionadas con AMCHAM',
        ]);

        DB::table('categorias')->insert([
            'id' => '3',
            'nombre' => 'CAMARAS INTERNACIONALES',
            'descripcion' => 'Son las camaras internacionales',
        ]);

        DB::table('categorias')->insert([
            'id' => '4',
            'nombre' => 'CLUB',
            'descripcion' => 'Se compone de clubes',
        ]);

        DB::table('categorias')->insert([
            'id' => '5',
            'nombre' => 'DESAFILIADO NO INVITAR SIN COSTO',
            'descripcion' => 'Desafiliado del sistema',
        ]);

        DB::table('categorias')->insert([
            'id' => '6',
            'nombre' => 'EMPRESAS USA',
            'descripcion' => 'Organizacion perteneciente a Estados Unidos',
        ]);

        DB::table('categorias')->insert([
            'id' => '7',
            'nombre' => 'GOBIERNO',
            'descripcion' => 'Organizaciones relacionadas al gobierno',
        ]);

        DB::table('categorias')->insert([
            'id' => '8',
            'nombre' => 'GREMIOS NO AFILIADOS',
            'descripcion' => 'Son los gremios no afiliados',
        ]);

        DB::table('categorias')->insert([
            'id' => '9',
            'nombre' => 'MEDIOS DE COMUNICACION',
            'descripcion' => 'Organizaciones de medios de comunicacion tradicionales y modernos',
        ]);

        DB::table('categorias')->insert([
            'id' => '10',
            'nombre' => 'NO AFILIADO',
            'descripcion' => 'Organizaciones NO AFILIADAS',
        ]);

        DB::table('categorias')->insert([
            'id' => '11',
            'nombre' => 'POTENCIAL',
            'descripcion' => 'EOrganizaciones potenciales a futuro',
        ]);
    }
}
