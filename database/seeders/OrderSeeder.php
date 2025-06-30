<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère Jane Doe
        $jane = User::where('email', 'jane.doe@example.com')->first();

        if (!$jane) {
            $this->command->warn('User Jane Doe not found. Run UserSeeder first.');
            return;
        }

        // Récupère les fournisseurs liés à Jane
        $suppliers = Supplier::where('user_id', $jane->user_id)->get();

        if ($suppliers->isEmpty()) {
            $this->command->warn('No suppliers found for Jane Doe. Run SupplierSeeder first.');
            return;
        }

        // Statuts possibles
        $statuses = ['pending', 'confirmed', 'delivered', 'cancelled'];

        for ($i = 1; $i <= 5; $i++) {
            $orderDate = now()->subDays(rand(1, 30));
            $expectedDate = (clone $orderDate)->addDays(rand(5, 15));
            $confirmedDate = null;

            // 50% chance que la livraison soit confirmée
            if (rand(0, 1)) {
                $confirmedDate = (clone $expectedDate)->subDays(rand(0, 3));
            }

            $status = $confirmedDate ? 'delivered' : $statuses[array_rand($statuses)];

            // Choisit un fournisseur aléatoirement
            $supplier = $suppliers->random();

            Order::create([
                'reference' => 'ORD-' . str_pad($i + 1000, 4, '0', STR_PAD_LEFT),
                'order_date' => $orderDate,
                'expected_delivery_date' => $expectedDate,
                'confirmed_delivery_date' => $confirmedDate,
                'status' => $status,
                'order_amount' => 0, // initialisé à zéro ici
                'supplier_id' => $supplier->id,
                'user_id' => $jane->user_id,
            ]);
        }
    }
}

