<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use \Illuminate\Support\Str;
class AdminUserSeeder extends Seeder
{
    public function run()
    {
     
        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            
            User::updateOrCreate(
                [ 'user_id' => 'PSALAZAR'], 
                [
                    'email' => 'admin@example.com',
                    'name' => 'Administrador',
                    'password' => Hash::make('adminpassword123'), 
                    'role_id' => $adminRole->role_id,
                    'created_by' => null, 
                ]
            );
        } else {
            $this->command->warn('El rol de administrador no se encontró. Asegúrate de ejecutar RoleSeeder primero.');
        }
    }
}
