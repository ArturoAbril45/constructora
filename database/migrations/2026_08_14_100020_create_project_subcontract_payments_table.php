<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_subcontract_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcontract_id')->constrained('project_subcontracts')->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->decimal('amount', 14, 2)->default(0);
            $table->date('pay_date');
            $table->text('comment')->nullable();
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_subcontract_payments');
    }
};
