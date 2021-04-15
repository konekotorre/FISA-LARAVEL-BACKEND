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
            'nombre' => 'Antigua y Barbuda',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Argentina',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Bahamas',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Barbados',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Belice',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Bolivia',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Brasil',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Canadá',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Chile',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Colombia',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Costa Rica',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Cuba',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Dominica',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Ecuador',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'El Salvador',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Estados Unidos',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Granada',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Guatemala',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Guyana',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Haití',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Honduras',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Jamaica',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'México',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Nicaragua',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Panamá',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Paraguay',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Perú',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'República Dominicana',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'San Cristóbal y Nieves',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'San Vicente y las Granadinas',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Santa Lucía',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Surinam',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Trinidad y Tobago',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Uruguay',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Venezuela',
        ]);

        DB::table('pais')->insert([
            'nombre' => 'Holanda',
        ]);
    }
}
