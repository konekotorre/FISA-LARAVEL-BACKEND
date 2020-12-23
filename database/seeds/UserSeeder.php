<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'nombres' => 'Administrador',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '123456789',
            'usuario' => 'Administrador',
            'password' => bcrypt('Fisa@1109'),
            'email' => 'Fisa01@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'nombres' => 'Empleado',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '12345678',
            'usuario' => 'Empleado',
            'password' => bcrypt('Fisa@1109'),
            'email' => 'Fisa02@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);
    }
}
