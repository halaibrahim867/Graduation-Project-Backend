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
        Schema::create('cows', function (Blueprint $table) {
            $table->id();
            $table->string('cowId',6)->unique();
            $table->foreignId('activityplace_id');
            $table->foreignId('activityplace_id')->constrained('activity_places');
            $table->foreignId('activitysystem_id');
            $table->foreignId('breadingsystem_id');
            $table->foreignId('purpose_id');
            $table->string('original_area');
            $table->string('appearance');
            $table->string('image');
            $table->enum('gender',['heifer','bull']);
            $table->dateTimeTz('entrance_date')->nullable();
            $table->dateTimeTz('age')->nullable();
            $table->decimal('weight');
            $table->decimal('milk_amount_morning')->nullable();
            $table->decimal('milk_amount_afternoon')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->boolean('cow_status')->default(true);
            $table->decimal('milk_amount');
            $table->decimal('heart_rate');
            $table->decimal('pressure');
            $table->decimal('temperature');
            $table->decimal('sugar_rate');
            $table->decimal('distance');
            $table->decimal('jaw_movement_rate');
            $table->decimal('movement_rate');
            $table->boolean('cow_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cows');
    }
};
