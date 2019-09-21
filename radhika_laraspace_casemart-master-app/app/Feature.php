<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['feature'];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
