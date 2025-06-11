<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = ['customer_id', 'street', 'number', 'complement', 'neighborhood', 'city', 'state', 'zip_code', 'label'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
