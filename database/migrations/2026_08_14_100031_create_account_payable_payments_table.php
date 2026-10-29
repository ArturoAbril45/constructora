<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_payable_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_payable_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('payment_method')->nullable();
            $table->decimal('amount', 14, 2)->default(0);
            $table->text('comment')->nullable();
            $table->foreignId('registered_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_payable_payments');
    }
};
