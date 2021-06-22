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
            'nombres' => 'Sandra',
            'apellidos' => 'Guañarita',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '10000000',
            'usuario' => 'SandraMaster',
            'password' => bcrypt('Fisa@1109'),
            'email' => 'sandra@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Diego',
            'apellidos' => 'Colmenares',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '20000000',
            'usuario' => 'DiegoMaster',
            'password' => bcrypt('Fisa@1109'),
            'email' => 'diego@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'José',
            'apellidos' => 'Santamaría',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '30000000',
            'usuario' => 'JoseMaster',
            'password' => bcrypt('Fisa@1109'),
            'email' => 'jose@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Batriz',
            'apellidos' => 'Albarez',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '1234567',
            'usuario' => 'Beatriz Admin',
            'password' => bcrypt('Fisa@777'),
            'email' => 'beatriz@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Administrador',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '1122334455',
            'usuario' => 'Admin',
            'password' => bcrypt('Fisa@555'),
            'email' => 'Fisa01@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Empleado',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '6677889900',
            'usuario' => 'Empleado',
            'password' => bcrypt('Fisa@444'),
            'email' => 'Fisa02@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

    }
}
