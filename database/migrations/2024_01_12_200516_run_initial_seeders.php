<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Call seeder
        Artisan::call('db:seed', [
            '--class' => 'PaymentMethodSeeder',
            '--force' => true
        ]);

        Artisan::call('db:seed', [
            '--class' => 'PaymentStatusSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
