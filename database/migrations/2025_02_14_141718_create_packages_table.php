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
            $table->string('slug')->unique();
            $table->string('tracking_number')->unique();
            $table->string('weight');
            $table->integer('unit_price');
            $table->integer('total_price')->nullable();
            $table->string('status');
            $table->date('date_dispatch')->nullable();
            $table->date('date_delivery')->nullable();
            $table->string('comment')->nullable();
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