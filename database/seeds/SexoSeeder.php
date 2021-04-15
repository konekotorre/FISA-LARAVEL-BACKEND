<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexos')->insert([
            'id' => '1',
            'nombre' => 'Masculino'
        ]);

        DB::table('sexos')->insert([
            'id' => '2',
            'nombre' => 'Femenino'
        ]);

        DB::table('sexos')->insert([
            'id' => '3',
            'nombre' => 'Otro'
        ]);
    }
}
