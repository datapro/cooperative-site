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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('requested_amount', 12, 2);
            $table->decimal('deducted_from_savings', 12, 2)->default(0);
            $table->decimal('amount_borrowed', 12, 2)->default(0);
            if (!Schema::hasColumn('loans', 'amount_repaid')) {
                $table->decimal('amount_repaid', 15, 2)->default(0);
            }
            if (!Schema::hasColumn('loans', 'status')) {
                $table->string('status')->default('active');
            }
            $table->string('g_form');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
