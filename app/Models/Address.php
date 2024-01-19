<?php

namespace App\Models;

use App\Models\Customer;

class Address extends AbstractModel
{
    protected $fillable = [
        'customer_id',
        'street',
        'number',
        'zip_code',
        'neighborhood',
        'city',
        'state',
        'country',
        'complement',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
