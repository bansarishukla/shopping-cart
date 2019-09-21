<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['price','order_id','quantity','name','image','case_id'];

    public function orders(){
        return $this->belongsTo(Order::class);
    }
}
