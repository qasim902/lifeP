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

    public function transactions(){
        return $this->hasManyThrough(Order::class,Transaction::class,'product_id','id','id','order_id');
    }
}
