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
        $master = Role::create(['name' => 'MasterUser']);

        $admin = Role::create(['name' => 'Administrador']);

        $empleado = Role::create(['name' => 'Empleado']);

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
        $user06->assignRole($empleado);
    }
}
