<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category'];
    
    function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
