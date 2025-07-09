<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Purchaser;

class RoleMigrationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Si déjà un admin ou purchaser, on ignore (sécurité)
            if ($user->admin || $user->purchaser) {
                continue;
            }

            // Migration selon le champ role
            if ($user->role === 'admin') {
                Admin::firstOrCreate(['user_id' => $user->user_id]);
            } elseif ($user->role === 'purchaser') {
                Purchaser::firstOrCreate(['user_id' => $user->user_id]);
            }
        }
    }
}

