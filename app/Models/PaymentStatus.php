<?php

namespace App\Models;

class PaymentStatus extends AbstractModel
{
    protected $fillable = [
        'name',
        'is_finished',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
