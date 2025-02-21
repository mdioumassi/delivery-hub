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
            $table->foreignId('company_id')->constrained('companies');
            $table->integer('package_id')->nullable();
            $table->integer('container_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};