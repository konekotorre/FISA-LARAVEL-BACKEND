<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiiuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed ciius
        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de cereales (excepto arroz), legumbres y semillas oleaginosas',
            'codigo' => '0111',
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de  arroz',
            'codigo' => '0112',
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de ortalizas, raíces y tubérculos',
            'codigo' => '0113'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de tabaco',
            'codigo' => '0114'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de plantas textiles',
            'codigo' => '0115'
        ]);
    }
}
