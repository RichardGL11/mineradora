<?php

namespace App\Models;

use App\Enums\FreightStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Freight extends Model
{
    /** @use HasFactory<\Database\Factories\FreightFactory> */
    use HasFactory;
    protected $guarded =[];
    protected $casts = ['status' => FreightStatus::class];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function driver():BelongsTo
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
