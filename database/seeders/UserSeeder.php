<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'manuelsr0113@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $adminRole = Role::where('role', 'admin')->first();

        $user->roles()->attach($adminRole->id);
    }
}
