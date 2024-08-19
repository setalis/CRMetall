<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation_id',
        'cart_id',
        'uniq_id',
        'product_id',
        'name',
        'price',
        'dirt',
        'weight',
        'weight_stock',
        'sum',
        'user_id'
    ];

    public function operation(): BelongsTo
    {
        return $this->belongsTo(Operation::class);
    }
}
