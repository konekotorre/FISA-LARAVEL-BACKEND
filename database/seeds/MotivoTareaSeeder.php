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
        DB::table('motivo_tarea')->insert([
            'nombre' => 'SEGUIMIENTO'
        ]);

        DB::table('motivo_tarea')->insert([
            'nombre' => 'SOLICITUDES'
        ]);

        DB::table('motivo_tarea')->insert([
            'nombre' => 'COBRO'
        ]);
    }
}
