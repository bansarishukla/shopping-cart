<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = ['total','subtotal','paid','user_id','id','pay','select','payment_method','category_id','product_id'];
    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
    public function addresses(){
        return $this->belongsToMany(Address::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
