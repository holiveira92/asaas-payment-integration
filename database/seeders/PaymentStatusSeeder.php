<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\PaymentStatusType;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_statuses')->updateOrInsert(
            ['id' => PaymentStatusType::CONFIRMED->value],
            [
                'id' => PaymentStatusType::CONFIRMED->value,
                'name' => "CONFIRMED",
                'is_finished' => 1,
            ],
        );

        DB::table('payment_statuses')->updateOrInsert(
            ['id' => PaymentStatusType::PENDING->value],
            [
                'id' => PaymentStatusType::PENDING->value,
                'name' => "PENDING",
                'is_finished' => 0
            ],
        );

        DB::table('payment_statuses')->updateOrInsert(
            ['id' => PaymentStatusType::CANCELLED->value],
            [
                'id' => PaymentStatusType::CANCELLED->value,
                'name' => "CANCELLED",
                'is_finished' => 1
            ],
        );
    }
}
