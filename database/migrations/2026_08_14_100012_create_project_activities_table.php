<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained();
            $table->string('description');
            $table->string('unit')->default('pza');
            $table->decimal('qty_budgeted', 14, 3)->default(0);
            $table->decimal('qty_consumed', 14, 3)->default(0);
            $table->decimal('unit_price', 14, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('percent_complete', 5, 2)->default(0);
            $table->boolean('finished')->default(false);
            $table->boolean('sum_to_total')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_activities');
    }
};
