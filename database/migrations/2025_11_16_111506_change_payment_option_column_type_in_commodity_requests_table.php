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
        Schema::table('commodity_requests', function (Blueprint $table) {
            //
            $table->string('payment_option', 100)->change(); // allow longer strings
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodity_requests', function (Blueprint $table) {
            //
            $table->string('payment_option', 100)->change(); // fallback if needed
        });
    }
};
