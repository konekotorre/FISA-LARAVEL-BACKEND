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
            'nombre' => 'A',
            'cuota_anual' => 6260000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'B',
            'cuota_anual' => 3960000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'C',
            'cuota_anual' => 2330000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'D',
            'cuota_anual' => 1255000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'AA',
            'cuota_anual' => 7110000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'E-AA',
            'cuota_anual' => 3555000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'E-A',
            'cuota_anual' => 3130000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'nombre' => 'CONVE',
            'cuota_anual' => 0,
            'temporada_cuota' => 2021
        ]);
    }
}

