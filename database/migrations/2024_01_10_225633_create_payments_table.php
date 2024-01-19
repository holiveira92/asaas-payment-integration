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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->decimal('amount', 10, 2);
            $table->string('order_number');

            $table->string('partner_transaction_id')->nullable();
            $table->uuid('method_id');
            $table->uuid('status_id');
            $table->uuid('customer_id');
            $table->longText('url')->nullable();
            $table->longText('qr_code')->nullable();
            $table->longText('copia_cola')->nullable();
            $table->date('due_date')->nullable();

            $table->foreign('method_id')->references('id')->on('payment_methods');
            $table->foreign('status_id')->references('id')->on('payment_statuses');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
