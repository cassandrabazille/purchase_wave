<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\User;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère Jane Doe
        $jane = User::where('email', 'jane.doe@example.com')->first();

        if (!$jane) {
            $this->command->warn('L\'utilisatrice "Jane Doe" est introuvable. Exécute d\'abord le UserSeeder.');
            return;
        }

        $suppliers = [
            [
                'name' => 'GlobalTextiles Co.',
                'email' => 'contact@globaltextiles.com',
                'telephone' => '+86 10 1234 5678',
                'address' => '88 Silk Road, Guangzhou, China',
            ],
            [
                'name' => 'TexWorld Imports',
                'email' => 'sales@texworld.com',
                'telephone' => '+91 22 2345 6789',
                'address' => 'Plot 12, Textile Market, Mumbai, India',
            ],
            [
                'name' => 'ModaTessile SRL',
                'email' => 'info@modatessile.it',
                'telephone' => '+39 02 1234 5678',
                'address' => 'Via della Moda 45, Milan, Italy',
            ],
            [
                'name' => 'FabricNation Ltd.',
                'email' => 'hello@fabricnation.co.uk',
                'telephone' => '+44 20 7946 1234',
                'address' => '21 Textile Street, Manchester, UK',
            ],
            [
                'name' => 'Andes Weavers',
                'email' => 'contact@andesweavers.pe',
                'telephone' => '+51 1 5678 9101',
                'address' => 'Avenida de la Moda 789, Lima, Peru',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create([
                ...$supplier,
                'user_id' => $jane->user_id,
            ]);
        }
    }
}

