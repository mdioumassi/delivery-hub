<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('package_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id')->nullable();
            $table->integer('container_id')->nullable();
            $table->integer('destination_id')->nullable();
            $table->dateTime('tracking_date');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_tracking');
    }
};