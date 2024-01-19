<?php

namespace App\Models;

class Payment extends AbstractModel
{
    protected $fillable = [
        'partner_transaction_id',
        'amount',
        'order_number',
        'method_id',
        'status_id',
        'customer_id',
        'url',
        'qr_code',
        'copia_cola',
        'due_date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        return $this->hasOne(PaymentStatus::class, 'id', 'status_id');
    }

    public function method()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'method_id');
    }

    public function http_transaction()
    {
        return $this->hasOne(PaymentHttpTransaction::class);
    }
}
