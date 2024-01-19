<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'order_number' => $this->order_number,
            'partner_transaction_id' => $this->partner_transaction_id,
            'url' => $this->url,
            'copia_cola' => $this->copia_cola,
            'qr_code' => $this->qr_code,
            'due_date' => $this->due_date,
            'payment_method' => $this->method,
            'payment_status' => $this->status,
            'customer' => $this->customer,
        ];
    }
}
