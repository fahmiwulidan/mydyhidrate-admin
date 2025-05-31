<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('dose');
            $table->enum('time', ['Pagi', 'Siang', 'Malam']);
            $table->integer('duration'); // dalam hari
            $table->boolean('taken')->default(false);
            $table->timestamp('taken_at')->nullable(); // kolom tambahan untuk catat waktu minum obat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
