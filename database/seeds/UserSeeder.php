<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name         = 'user';
        $role_user->display_name = 'User'; // optional
        $role_user->description  = 'Usuario para navegar'; // optional
        $role_user->save();

        $user = new User();
        $user->name = 'test';
        $user->email ='test@test.com';
        $user->password = Hash::make('abc123');
        $user->save();
        $user->attachRole($role_user);

        $role_root = new Role();
        $role_root->name         = 'root';
        $role_root->display_name = 'root'; // optional
        $role_root->description  = 'Control total del sitio'; // optional
        $role_root->save();

        $root = new User();
        $root->name = 'root';
        $root->email ='root@dev.com';
        $root->password = Hash::make('rootmi2018');
        $root->save();
        $root->attachRole($role_root);

        $role_admin = new Role();
        $role_admin->name         = 'admin';
        $role_admin->display_name = 'Admin'; // optional
        $role_admin->description  = 'Administrador del portal'; // optional
        $role_admin->save();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email ='admin@test.com';
        $admin->password = Hash::make('abc123');
        $admin->save();
        $admin->attachRole($role_admin);
    }
}
