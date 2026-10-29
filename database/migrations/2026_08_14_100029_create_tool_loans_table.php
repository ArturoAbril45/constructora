<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tool_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('employee_id')->nullable()->constrained();
            $table->integer('qty')->default(1);
            $table->date('loan_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['loaned', 'returned'])->default('loaned');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tool_loans');
    }
};
