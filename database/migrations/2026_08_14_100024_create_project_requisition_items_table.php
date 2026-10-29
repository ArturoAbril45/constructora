<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_requisition_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisition_id')->constrained('project_requisitions')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->decimal('qty', 14, 3)->default(0);
            $table->decimal('qty_ordered', 14, 3)->default(0);
            $table->string('receiver_name')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_requisition_items');
    }
};
