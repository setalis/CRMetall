<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the total cost of the order.
     *
     * @return float
     */
    public function getTotalCost()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->product->price;
        });
    }
}
