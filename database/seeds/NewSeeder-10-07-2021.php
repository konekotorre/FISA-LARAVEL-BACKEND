<?php

use Illuminate\Database\Seeder;

class NewSeeder-10-07-2021 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombres' => 'Consultor',
            'apellidos' => 'Sistema',
            'tipo_documento_persona_id' => '1',
            'numero_documento' => '99999999',
            'usuario' => 'Consulta',
            'password' => bcrypt('Fisa@1234'),
            'email' => 'consulta@amcham.com',
            'estado' => true,
            'usuario_creacion' => '1',
            'usuario_actualizacion' => '1',
        ]);

        $consulta = Role::create(['name' => 'Consulta']);

        $user13 = User::find(14);
        $user01->assignRole($consulta);
    }
}
