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
        Schema::create('payment_http_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->json('request');
            $table->json('response');
            $table->string('payment_id');
            $table->string('client_ip_address')->nullable();


            $table->foreign('payment_id')->references('id')->on('payments');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_http_transactions');
    }
};
