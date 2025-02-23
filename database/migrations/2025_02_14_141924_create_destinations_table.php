<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('flight_name', 50);
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('package_id')->nullable()->constrained('packages');
            $table->foreignId('container_id')->nullable()->constrained('containers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};