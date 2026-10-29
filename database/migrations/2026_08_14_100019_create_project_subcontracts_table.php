<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_subcontracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('provider_id')->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained();
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('amount', 14, 2)->default(0);
            $table->foreignId('authorized_by')->nullable()->constrained('users');
            $table->enum('status', ['generated', 'authorized', 'in_process', 'finished', 'cancelled'])->default('generated');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_subcontracts');
    }
};
