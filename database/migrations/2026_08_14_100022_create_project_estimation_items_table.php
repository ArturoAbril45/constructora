<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_estimation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimation_id')->constrained('project_estimations')->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained('project_activities');
            $table->decimal('qty', 14, 3)->default(0);
            $table->decimal('unit_price', 14, 2)->default(0);
            $table->decimal('amount', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_estimation_items');
    }
};
