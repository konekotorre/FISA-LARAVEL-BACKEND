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
            'cuota_anual' => 6260000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '2',
            'nombre' => 'B',
            'cuota_anual' => 3960000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '3',
            'nombre' => 'C',
            'cuota_anual' => 2330000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '4',
            'nombre' => 'D',
            'cuota_anual' => 1255000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '5',
            'nombre' => 'AA',
            'cuota_anual' => 7110000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '6',
            'nombre' => 'E-AA',
            'cuota_anual' => 3555000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '7',
            'nombre' => 'E-A',
            'cuota_anual' => 3130000,
            'temporada_cuota' => 2021
        ]);

        DB::table('clasificacions')->insert([
            'id' => '8',
            'nombre' => 'CONVE',
            'cuota_anual' => 0,
            'temporada_cuota' => 2021
        ]);
    }
}

