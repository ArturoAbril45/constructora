<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_piecework_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->enum('worker_type', ['employee', 'provider'])->default('employee');
            $table->foreignId('employee_id')->nullable()->constrained();
            $table->foreignId('provider_id')->nullable()->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total', 14, 2)->default(0);
            $table->enum('status', ['requested', 'authorized', 'paid', 'cancelled'])->default('requested');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_piecework_requests');
    }
};
