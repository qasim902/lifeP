<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Order extends Model
{
    use HasFactory, SoftDeletes, Userstamps;


    protected $dispatchesEvents = [
        'created' => \App\Events\OrderCreation::class,
    ];


    public function transactions(){
        return $this->hasMany(Transaction::class,'order_id','id');
    }
}
