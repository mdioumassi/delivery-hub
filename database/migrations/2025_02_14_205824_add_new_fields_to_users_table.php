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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('civility', ['Mr', 'Mrs', 'Miss']); 
            $table->enum('role', ['admin', 'user', 'manager']);
            $table->string('lastname')->nullable();
            $table->string('phone')->nullable();
            $table->enum('type', ['gestionnaire', 'client']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['civility', 'role', 'lastname', 'phone']);
            $table->string('email', 255)->change();
        });
    }
};
