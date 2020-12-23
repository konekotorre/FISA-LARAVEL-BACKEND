<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed countrys

        DB::table('pais')->insert([
            'id' => '1',
            'nombre' => 'Antigua y Barbuda',
        ]);

        DB::table('pais')->insert([
            'id' => '2',
            'nombre' => 'Argentina',
        ]);

        DB::table('pais')->insert([
            'id' => '3',
            'nombre' => 'Bahamas',
        ]);

        DB::table('pais')->insert([
            'id' => '4',
            'nombre' => 'Barbados',
        ]);

        DB::table('pais')->insert([
            'id' => '5',
            'nombre' => 'Belice',
        ]);

        DB::table('pais')->insert([
            'id' => '6',
            'nombre' => 'Bolivia',
        ]);

        DB::table('pais')->insert([
            'id' => '7',
            'nombre' => 'Brasil',
        ]);

        DB::table('pais')->insert([
            'id' => '8',
            'nombre' => 'Canadá',
        ]);

        DB::table('pais')->insert([
            'id' => '9',
            'nombre' => 'Chile',
        ]);

        DB::table('pais')->insert([
            'id' => '10',
            'nombre' => 'Colombia',
        ]);

        DB::table('pais')->insert([
            'id' => '11',
            'nombre' => 'Costa Rica',
        ]);

        DB::table('pais')->insert([
            'id' => '12',
            'nombre' => 'Cuba',
        ]);

        DB::table('pais')->insert([
            'id' => '13',
            'nombre' => 'Dominica',
        ]);

        DB::table('pais')->insert([
            'id' => '14',
            'nombre' => 'Ecuador',
        ]);

        DB::table('pais')->insert([
            'id' => '15',
            'nombre' => 'El Salvador',
        ]);

        DB::table('pais')->insert([
            'id' => '16',
            'nombre' => 'Estados Unidos',
        ]);

        DB::table('pais')->insert([
            'id' => '17',
            'nombre' => 'Granada',
        ]);

        DB::table('pais')->insert([
            'id' => '18',
            'nombre' => 'Guatemala',
        ]);

        DB::table('pais')->insert([
            'id' => '19',
            'nombre' => 'Guyana',
        ]);

        DB::table('pais')->insert([
            'id' => '20',
            'nombre' => 'Haití',
        ]);

        DB::table('pais')->insert([
            'id' => '21',
            'nombre' => 'Honduras',
        ]);

        DB::table('pais')->insert([
            'id' => '22',
            'nombre' => 'Jamaica',
        ]);

        DB::table('pais')->insert([
            'id' => '23',
            'nombre' => 'México',
        ]);

        DB::table('pais')->insert([
            'id' => '24',
            'nombre' => 'Nicaragua',
        ]);

        DB::table('pais')->insert([
            'id' => '25',
            'nombre' => 'Panamá',
        ]);

        DB::table('pais')->insert([
            'id' => '26',
            'nombre' => 'Paraguay',
        ]);

        DB::table('pais')->insert([
            'id' => '27',
            'nombre' => 'Perú',
        ]);

        DB::table('pais')->insert([
            'id' => '28',
            'nombre' => 'República Dominicana',
        ]);

        DB::table('pais')->insert([
            'id' => '29',
            'nombre' => 'San Cristóbal y Nieves',
        ]);

        DB::table('pais')->insert([
            'id' => '30',
            'nombre' => 'San Vicente y las Granadinas',
        ]);

        DB::table('pais')->insert([
            'id' => '31',
            'nombre' => 'Santa Lucía',
        ]);

        DB::table('pais')->insert([
            'id' => '32',
            'nombre' => 'Surinam',
        ]);

        DB::table('pais')->insert([
            'id' => '33',
            'nombre' => 'Trinidad y Tobago',
        ]);

        DB::table('pais')->insert([
            'id' => '34',
            'nombre' => 'Uruguay',
        ]);

        DB::table('pais')->insert([
            'id' => '35',
            'nombre' => 'Venezuela',
        ]);
    }
}
