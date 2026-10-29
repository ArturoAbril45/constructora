<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained();
            $table->decimal('qty_budgeted', 14, 3)->default(0);
            $table->decimal('qty_consumed', 14, 3)->default(0);
            $table->decimal('unit_price', 14, 2)->default(0);
            $table->boolean('extraordinary')->default(false);
            $table->boolean('sum_to_total')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_budget_items');
    }
};
