<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('users', function (Blueprint $table) {
        $table->string('ledger_no')->nullable()->after('id');
        $table->decimal('savingsBF', 15, 2)->default(0)->after('ledger_no');
        $table->decimal('loanBF', 15, 2)->default(0)->after('savingsBF');
        $table->decimal('commBF', 15, 2)->default(0)->after('loanBF');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['ledger_no', 'savingsBF', 'loanBF', 'commBF']);
        });
    }
};
