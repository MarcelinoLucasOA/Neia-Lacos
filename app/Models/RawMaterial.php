<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'unit',
        'cost_per_unit',
        'min_stock_level',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Se você planeja ter relacionamentos, adicione-os aqui.
    // Por exemplo, se uma matéria-prima pode ser usada em vários produtos:
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)->withPivot('quantity');
    // }
}
