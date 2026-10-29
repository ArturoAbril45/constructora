<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('account_payables', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->after('reference');
            $table->string('bank')->nullable()->after('payment_type');
            $table->string('voucher_path')->nullable()->after('bank');
        });
    }

    public function down(): void
    {
        Schema::table('account_payables', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'bank', 'voucher_path']);
        });
    }
};
