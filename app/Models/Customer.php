<?php

namespace App\Models;

use App\Models\AbstractModel;

class Customer extends AbstractModel
{
    protected $fillable = [
        'email',
        'name',
        'document',
        'phone',
        'external_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
