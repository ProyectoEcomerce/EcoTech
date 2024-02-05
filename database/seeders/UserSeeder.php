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
        $adminUser= User::create([
            'name' => 'admin',
            'email' => 'manuelsr0113@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $adminRole = Role::where('role', 'admin')->first();
        if ($adminRole) {
            $adminUser->roles()->attach($adminRole); // Si estás utilizando una tabla pivot para roles
        } else {
            $adminUser->role = 'admin'; // Si estás utilizando un campo directo en la tabla de usuarios
            $adminUser->save();
        }
    }
}
