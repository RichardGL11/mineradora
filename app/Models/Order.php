<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['user_id','id','total','status'];
    protected $casts = ['status' => OrderStatus::class];

    public function user():BelongsTo
    {
        return $this->belongsto(User::class);
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_product')
            ->withPivot('quantity','price')
            ->withTimestamps();
    }
}
