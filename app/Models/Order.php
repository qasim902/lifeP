<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Order extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = ['price','tax','total','user_id'];

    protected $dispatchesEvents = [
        'created' => \App\Events\OrderCreation::class,
    ];


    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class, 'order_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Product::class,OrderProduct::class,'order_id','id','id','product_id');
    }

}
