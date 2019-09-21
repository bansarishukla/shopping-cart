<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name','address','pincode','phoneNumber','city','state','phone','user_id'];
}
