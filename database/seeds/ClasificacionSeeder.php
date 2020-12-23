<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clasificacions')->insert([
            'id' => '1',
            'nombre' => 'A',
            'descripcion' => 'mas de 1 e pleaso y menos de 10',
            'cuota_anual' => 40000,
            'temporada_cuota' => 2020
        ]);

        DB::table('clasificacions')->insert([
            'id' => '2',
            'nombre' => 'B',
            'descripcion' => 'Entre 10 y 20 empleados',
            'cuota_anual' => 50000,
            'temporada_cuota' => 2020
        ]);

        DB::table('clasificacions')->insert([
            'id' => '3',
            'nombre' => 'C',
            'descripcion' => 'Más de 20 empleados',
            'cuota_anual' => 60000,
            'temporada_cuota' => 2020
        ]);
    }
}

