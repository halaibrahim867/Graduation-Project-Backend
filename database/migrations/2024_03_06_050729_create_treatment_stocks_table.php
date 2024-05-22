<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treatment_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTimeTz('manufacturing_date');
            $table->string('manufacturing_code');
            $table->dateTimeTz('validation_period');
            $table->dateTimeTz('entrance_date');
            $table->string('producer');
            $table->string('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_stocks');
    }
};
