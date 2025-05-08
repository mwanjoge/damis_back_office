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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->foreignId('request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_date')->default(now());
            $table->string('due_date')->default(now()->addMonth());
            $table->string('customer_name')->nullable();
            $table->string('ref_no')->nullable();
            $table->enum('status', ['pending','paid','cancelled','overdue'])->default('pending');
            $table->enum('sent_status', ['sent','failed']);
            $table->string('currency')->default('TZS');
            $table->boolean('is_paid')->default(false);
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('payable_amount', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);
            $table->decimal('paid', 12, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
