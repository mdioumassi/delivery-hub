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
            $table->string('type'); // À adapter selon vos besoins
            $table->string('weight');
            $table->decimal('unit_price', 10, 2);
            $table->boolean('status');
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('recipient_id')->constrained('users');
            $table->foreignId('service_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};