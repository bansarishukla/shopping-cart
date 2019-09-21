<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','phone_id','image','stock'];
  
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function features(){
        return $this->belongsToMany(Feature::class);
    }
     
    public function phones(){
        return $this->belongsTo(Phone::class);
    }
}
