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
        // Seed regimens

        DB::table('regimens')->insert([
            'id' => '1',
            'nombre' => 'Regimen Contributivo',
            'descripcion' => 'Contribuye'
        ]);

        DB::table('regimens')->insert([
            'id' => '2',
            'nombre' => 'Regimen Subsidiado',
            'descripcion' => 'No contribuye'
        ]);
    }
}
