<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Class

        DB::table('clases')->insert([
            'id' => '1',
            'nombre' => 'Microempresa',
            'descripcion' => '0-9 empleados'
        ]);

        DB::table('clases')->insert([
            'id' => '2',
            'nombre' => 'Pequeñas empresas',
            'descripcion' => '10-49 empleados'
        ]);

        DB::table('clases')->insert([
            'id' => '3',
            'nombre' => 'Medianas empresas',
            'descripcion' => '50-249 empleados'
        ]);

        DB::table('clases')->insert([
            'id' => '4',
            'nombre' => 'Empresas grandes',
            'descripcion' => 'Más de 250 empleados'
        ]);

    }
}
