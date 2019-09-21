<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Phone;
Use App\Category;
Use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class PhoneController extends Controller
{
    function add(){
        
        $name = phone::all();
        return $name;
    }
    function create(){
        $phone = Phone::create([
            'phone' => request('phonemodel')
        ]);
        return $phone;
    }   
    function deletePhoneModel($id){
        Phone::where('id',$id)->delete();
        return "done";  
    }
    public function catList(){
        $cat = Phone::all();
        return view('welcome',compact('cat'));
    }

    public function catCase($phoneType,$id){
        $phone  = Phone::where('id',$id)->get();
        $category = Category::all(); 
        $product = array(); 
        if($phoneType == 0)
        {
            $product = Product::where('phone_id',$id)->get();  
        }
        else{
            $cat = Category::find($phoneType);
            $take = $cat->products; 
            $i = 0;
            foreach($take as $took)
            {
                if($took->phone_id == $id)
                {
                    $i++;
                    array_push($product,$took);
                }
                else{
    
                }
            }
        }
        return view('cat_case',compact('product',"phone",'category'));
    }
}
