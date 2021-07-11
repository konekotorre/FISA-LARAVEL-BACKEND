<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*         $master = Role::create(['name' => 'MasterUser']);

        $admin = Role::create(['name' => 'Administrador']);

        $soporte = Role::create(['name' => 'Soporte']);

        $comercial = Role::create(['name' => 'Comercial']);

        $user01 = User::find(1);
        $user01->assignRole($master);

        $user02 = User::find(2);
        $user02->assignRole($master);

        $user03 = User::find(3);
        $user03->assignRole($master);

        $user04 = User::find(4);
        $user04->assignRole($admin);

        $user05 = User::find(5);
        $user05->assignRole($admin);

        $user06 = User::find(6);
        $user06->assignRole($admin);

        $user07 = User::find(7);
        $user07->assignRole($soporte);

        $user08 = User::find(8);
        $user08->assignRole($soporte);

        $user09 = User::find(9);
        $user09->assignRole($comercial);

        $user10 = User::find(10);
        $user10->assignRole($comercial);

        $user11 = User::find(11);
        $user11->assignRole($comercial);

        $user12 = User::find(12);
        $user12->assignRole($comercial);

        $user13 = User::find(13);
        $user13->assignRole($comercial);
 */
/*         DB::table('users')->insert([
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
*/
        $consulta = Role::create(['name' => 'Consulta']);
 
        $user14 = User::find(14);
        $user14->assignRole($consulta);
    }
}
