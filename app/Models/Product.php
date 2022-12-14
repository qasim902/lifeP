<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use HasFactory, SoftDeletes, Userstamps;
    protected $table = 'products';

    protected $fillable = ['price','tax','total','name','description'];
    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Order::class,Transaction::class,'product_id','id','id','order_id');
    }
}
