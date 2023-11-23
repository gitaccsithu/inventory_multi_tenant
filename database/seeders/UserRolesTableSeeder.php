<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_roles = ['super_admin', 'admin', 'tenant'];
        if(UserRole::count() === 0) {
            foreach ($user_roles as $key => $role) {
                UserRole::create([
                    'role' => $role
                ]);
            }
        }
    }
}
