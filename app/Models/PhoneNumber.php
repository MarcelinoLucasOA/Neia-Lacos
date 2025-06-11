<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneNumber extends Model
{
    protected $fillable = ['customer_id', 'number', 'label'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
