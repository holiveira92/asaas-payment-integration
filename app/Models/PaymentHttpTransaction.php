<?php

namespace App\Models;

class PaymentHttpTransaction extends AbstractModel
{
    protected $fillable = [
        'request',
        'response',
        'payment_id',
        'client_ip_address',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
