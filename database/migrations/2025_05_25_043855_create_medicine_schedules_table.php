<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('medicine_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->time('time');
            $table->time('reminder_time')->nullable();
            $table->timestamps(); // ini penting agar ada created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicine_schedules');
    }
}
