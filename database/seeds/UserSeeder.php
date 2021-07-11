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
            'email' => 'sguanarita@uao.edu.co',
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
            'email' => 'jose.santa.andra@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

                 
        DB::table('users')->insert([
            'nombres' => 'Administrador',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '1122334455',
            'usuario' => 'Administrador',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'Fisa01@gmail.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Batriz',
            'apellidos' => 'Alvarez',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '31282453',
            'usuario' => 'BeatrizAJ',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'administrativo@amchamcali.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Juan Guillermo',
            'apellidos' => 'Baena',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '111111111',
            'usuario' => 'JuanGB',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar00@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Aura',  
            'apellidos' => 'Muñoz',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '22222222',
            'usuario' => 'AuraM',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar01@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Jhon Freddy',
            'apellidos' => 'Serna',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '33333333',
            'usuario' => 'JhonFS',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar02@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);
        
        DB::table('users')->insert([
            'nombres' => 'Ana Lucia',
            'apellidos' => 'Jaramillo',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '44444444',
            'usuario' => 'AnaLJ',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar03@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Andrea',
            'apellidos' => 'Bersh',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '55555555',
            'usuario' => 'AndreaB',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar04@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Daniela',
            'apellidos' => 'Campo',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '66666666',
            'usuario' => 'DanielaC',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar05@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Tatiana',
            'apellidos' => 'Zuñiga',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '77777777',
            'usuario' => 'TatianaZ',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar06@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Juan Camilo',
            'apellidos' => 'Quintero',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '88888888',
            'usuario' => 'JuanCQ',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'correoporconfirmar07@correo.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        DB::table('users')->insert([
            'nombres' => 'Consultor',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '79867986',
            'usuario' => 'Consulta',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'consulta@amcham.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

    }
}
