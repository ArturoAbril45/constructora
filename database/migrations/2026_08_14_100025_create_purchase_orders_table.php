<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requisition_id')->nullable()->constrained('project_requisitions')->nullOnDelete();
            $table->foreignId('provider_id')->nullable()->constrained();
            $table->foreignId('transfer_from_warehouse_id')->nullable()->constrained('warehouses');
            $table->boolean('requires_invoice')->default(true);
            $table->date('date');
            $table->boolean('checklist_complete')->default(false);
            $table->enum('status', ['pending', 'authorized', 'in_process', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
