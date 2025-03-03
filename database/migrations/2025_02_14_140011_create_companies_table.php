<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo_url')->nullable();
            $table->string('phone_fixe')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_whatsapp')->nullable();
            $table->string('email');
            $table->string('street');
            $table->string('city');
            $table->string('zip_code');
            $table->string('country')->default('France');
            $table->string('siret')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('gestionnaire_id')->constrained('users'); // <-- "users" au lieu de "user"
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
