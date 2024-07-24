<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cash extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_operation',
        'sum_operation',
        'summary_cash',
        'operation_id',
    ];

    public function operation(): BelongsTo
    {
        return $this->belongsTo(Operation::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => CarbonImmutable::make($value)->format('d-m-Y H:i')
        );
    }

//    public function operation(): BelongsTo
//    {
//        return $this->belongsTo(Operation::class);
//    }

}
