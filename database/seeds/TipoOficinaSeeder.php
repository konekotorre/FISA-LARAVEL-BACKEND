<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoOficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_oficinas')->insert([
            'id' => '1',
            'nombre' => 'Principal',
        ]);

        DB::table('tipo_oficinas')->insert([
            'id' => '2',
            'nombre' => 'Sede',
        ]);

        }
}
