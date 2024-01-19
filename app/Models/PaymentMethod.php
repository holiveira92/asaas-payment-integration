<?php

namespace App\Models;

class PaymentMethod extends AbstractModel
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'max_installments',
        'discount',
        'increase',
        'activated',
        'extra_options',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
