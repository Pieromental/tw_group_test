<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run()
    {
     
        $roles = [
            ['name' => 'admin', 'created_by' => null],
            ['name' => 'client', 'created_by' => null],
        ];

    
        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']], 
                [
                    'role_id' => (string) Str::uuid(), 
                    'created_by' => $roleData['created_by']
                ]
            );
        }
    }
}
