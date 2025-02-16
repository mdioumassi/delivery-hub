<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['baril', 'valise', 'vehicule']); // À adapter selon vos besoins
            $table->decimal('unit_price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // <-- "users" au lieu de "user"
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('containers');
    }
};