<?php

namespace App\Http\Requests\Payments;

use App\Enums\PaymentMethodType;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CreditCardRule;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $creditCardMethodId = PaymentMethodType::CREDIT_CARD->value;
        $creditCardRule = "required_if:payment.method_id,=,$creditCardMethodId";

        $rules = [
            /******************* RELACIONADO AO CLIENTE *******************************/
            'customer' => ['required', 'array'],
            'customer.name' => ['required'],
            'customer.email' => ['required', 'email'],
            'customer.phone' => ['required'],
            'customer.document' => ['required'],

            /******************* RELACIONADO AO ENDERECO DO CLIENTE *******************************/
            'customer.address' => ['required', 'array'],
            'customer.address.street' => ['required', 'string'],
            'customer.address.number' => ['required', 'string'],
            'customer.address.complement' => ['nullable'],
            'customer.address.neighborhood' => ['required', 'string'],
            'customer.address.zip_code' => ['required', 'string'],
            'customer.address.city' => ['required', 'string'],
            'customer.address.state' => ['required', 'string'],
            'customer.address.country' => ['required', 'string'],

            /******************* RELACIONADO AO PAGAMENTO *******************************/
            'payment' => ['required', 'array'],
            'payment.method_id' => ['required', 'uuid', 'exists:payment_methods,id'],
            'payment.amount' => ['required', 'numeric'],
            'payment.installments' => ['required', 'integer'],
            'payment.due_date' => ["required", 'string'],

            /******************* RELACIONADO AO PAGAMENTO POR CARTAO DE CREDITO *******************************/
            'payment.credit_card' => [$creditCardRule, 'array'],
            'payment.credit_card.holder_name' => [$creditCardRule, 'string'],
            'payment.credit_card.number' => [$creditCardRule, 'string'],
            'payment.credit_card.expiry_month' => [$creditCardRule, 'string'],
            'payment.credit_card.expiry_year' => [$creditCardRule, 'string'],
            'payment.credit_card.cvv' => [$creditCardRule, 'string', 'min:3', 'max:4'],
        ];

        return $rules;
    }
}

