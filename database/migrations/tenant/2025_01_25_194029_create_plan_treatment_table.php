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
        Schema::create('plan_treatment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_plan_id')->index()->constrained('treatment_plans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('treatment_id')->index()->constrained();
            $table->string('discount')->nullable();
            $table->tinyInteger('tooth');
            $table->date('treatment_date')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_treatment');
    }
};
