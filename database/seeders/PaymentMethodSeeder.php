<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\PaymentMethodType;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cartão de Crédito Configs
        DB::table('payment_methods')->updateOrInsert(
            ['id' => PaymentMethodType::CREDIT_CARD->value],
            [
                'id' => PaymentMethodType::CREDIT_CARD->value,
                'name' => "CreditCard",
                'slug' => "credit_card",
                'description' => "Cartão de Crédito",
                'max_installments' => 12,
                'discount' => 0,
                'increase' => 0,
                'activated' => 1,
                'extra_options' => null
            ],
        );

        // Boleto Configs
        DB::table('payment_methods')->updateOrInsert(
            ['id' => PaymentMethodType::BOLETO->value],
            [
                'id' => PaymentMethodType::BOLETO->value,
                'name' => "Boleto",
                'slug' => "boleto",
                'description' => "Boleto Bancário",
                'max_installments' => 1,
                'discount' => 0,
                'increase' => 0,
                'activated' => 1,
                'extra_options' => null
            ],
        );

        // Pix Configs
        DB::table('payment_methods')->updateOrInsert(
            ['id' => PaymentMethodType::PIX->value],
            [
                'id' => PaymentMethodType::PIX->value,
                'name' => "Pix",
                'slug' => "pix",
                'description' => "Pix",
                'max_installments' => 1,
                'discount' => 0,
                'increase' => 0,
                'activated' => 1,
                'extra_options' => null
            ],
        );
    }
}
