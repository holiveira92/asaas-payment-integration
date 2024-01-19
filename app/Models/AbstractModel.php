<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class AbstractModel extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->created_at);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->updated_at);
    }

    public function getDeletedAt(): Carbon
    {
        return Carbon::parse($this->deleted_at);
    }

}
