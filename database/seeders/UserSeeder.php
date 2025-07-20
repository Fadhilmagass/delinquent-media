<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan roles sudah tersedia di tabel roles
        $roles = ['admin', 'editor', 'contributor', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Data pengguna
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Editor User',
                'email' => 'editor@example.com',
                'role' => 'editor',
            ],
            [
                'name' => 'Contributor User',
                'email' => 'contributor@example.com',
                'role' => 'contributor',
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'role' => 'user',
            ],
        ];

        // Buat dan assign role ke setiap user
        foreach ($users as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password default
            ]);

            $user->assignRole($data['role']);
        }
    }
}
