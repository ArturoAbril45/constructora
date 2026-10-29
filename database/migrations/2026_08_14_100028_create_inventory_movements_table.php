<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->enum('type', ['in', 'out', 'transfer_in', 'transfer_out', 'adjustment'])->default('in');
            $table->decimal('qty', 14, 3)->default(0);
            $table->decimal('unit_cost', 14, 2)->default(0);
            $table->foreignId('purchase_order_id')->nullable()->constrained();
            $table->foreignId('received_by')->nullable()->constrained('users');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
