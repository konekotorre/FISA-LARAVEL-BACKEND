<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('regimens')->insert([
            'nombre' => 'Regimen Contributivo',
            'descripcion' => 'Contribuye'
        ]);

        DB::table('regimens')->insert([
            'nombre' => 'Regimen Subsidiado',
            'descripcion' => 'No contribuye'
        ]);
    }
}
