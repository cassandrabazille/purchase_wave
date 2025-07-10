<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['email', 'name', 'password']);
            $table->uuid('user_id')->unique()->constrained('users')->onDelete('cascade');
        });
    }

};
