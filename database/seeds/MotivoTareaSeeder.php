<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoTareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motivo_tareas')->insert([
            'nombre' => 'SEGUIMIENTO'
        ]);

        DB::table('motivo_tareas')->insert([
            'nombre' => 'SOLICITUDES'
        ]);

        DB::table('motivo_tareas')->insert([
            'nombre' => 'COBRO'
        ]);
    }
}
