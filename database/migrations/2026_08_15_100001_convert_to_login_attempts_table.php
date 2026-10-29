<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('failed_login_attempts', 'login_attempts');

        Schema::table('login_attempts', function (Blueprint $table) {
            $table->boolean('successful')->default(false)->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('login_attempts', function (Blueprint $table) {
            $table->dropColumn('successful');
        });

        Schema::rename('login_attempts', 'failed_login_attempts');
    }
};
