<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
//    protected $fillable = [
//        'name',
//        'price_buy',
//        'price_sell',
//        'price_discount',
//        'weight_discount',
//        'dirt',
//        'count',
//        'slug',
//        'is_published',
//        'image',
//    ];

    protected $guarded = [];

//    public function orderItems(){
//        return $this->hasMany(OrderItem::class);
//    }
}
