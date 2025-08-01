<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Migration pour créer la table des commandes d'achat ("orders").
     */
    public function up(): void
    {
        // Création de la table "orders" avec ses relations et colonnes clés
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->date('order_date');
            $table->date('expected_delivery_date');
            $table->date('confirmed_delivery_date')->nullable();
            $table->string('status');
            $table->decimal('order_amount', 10, 2);
            $table->uuid('user_id')->nullable()->index();
            $table->unsignedBigInteger('supplier_id')->nullable()->index();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
        });
    }

    /**
     * Supprime la table "orders" si elle existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
