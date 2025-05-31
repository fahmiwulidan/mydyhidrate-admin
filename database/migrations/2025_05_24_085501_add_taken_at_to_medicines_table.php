<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTakenAtToMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->timestamp('taken_at')->nullable()->after('taken');
        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn('taken_at');
        });
    }
}
