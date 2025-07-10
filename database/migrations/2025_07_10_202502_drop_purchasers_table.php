<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
    {
        Schema::dropIfExists('purchasers');
    }

    public function down(): void
    {
        Schema::create('purchasers', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

};
