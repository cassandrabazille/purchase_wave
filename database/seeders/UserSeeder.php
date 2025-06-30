<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Crée un admin fixe
            User::create([
            'user_id' => (string) Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'), // mot de passe hashé
            'role' => UserRole::Admin,
        ]);

        // Création d'un purchaser femme avec données fixes
        User::create([
            'user_id' => (string) Str::uuid(),
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password123'),
            'role' => UserRole::Purchaser,
        ]);
    }
}
