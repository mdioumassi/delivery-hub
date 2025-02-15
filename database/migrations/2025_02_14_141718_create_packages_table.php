<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) { // Correction du nom de la table au pluriel
            $table->id();
            $table->enum('type', ['medicament', 'bagage', 'document', 'autre'])->nullable(); // À adapter selon vos besoins
            $table->string('weight');
            $table->decimal('unit_price', 10, 2);
            $table->boolean('status')->default(true);
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // <-- "users" au lieu de "user"
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};