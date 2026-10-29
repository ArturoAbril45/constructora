<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_receivables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('client_id')->nullable()->constrained();
            $table->string('receivable_type');
            $table->unsignedBigInteger('receivable_id')->nullable();
            $table->string('reference')->nullable();
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->decimal('collected_amount', 14, 2)->default(0);
            $table->enum('status', ['pending', 'partial', 'collected'])->default('pending');
            $table->timestamps();
            $table->index(['receivable_type', 'receivable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_receivables');
    }
};
