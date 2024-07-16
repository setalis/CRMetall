<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'cart_id',
        'products',
        'sum',
        'sumCart',
        'comment',
        'status',
        'is_published',
    ];
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function cash(): HasMany
    {
        return $this->hasMany(Cash::class);
    }

}
