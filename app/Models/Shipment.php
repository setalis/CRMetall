<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable =[
        'product_id',
        'weight_shipment',
        'weight_actually',
        'price_shipment',
        'price_actually',
    ];
}
