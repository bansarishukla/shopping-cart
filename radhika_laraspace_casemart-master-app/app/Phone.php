<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
   protected $fillable = ['phone'];
 
    function products(){
        return $this->hasMany(Product::class);
    }
}
