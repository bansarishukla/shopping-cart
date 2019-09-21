<?php

namespace App\Http\Controllers;
use App\Product;
use App\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function getproduct($id){
        $product = Product::find($id);
        return $product;
    }
    public function addfeature($id){
        $feature = Feature::create([
            'feature' => request('feature')
        ]);
        $f_id =$feature->id;
        $product = Product::find($id);
        $product->features()->attach($f_id);
        return $feature;
    }  
    public function getfeature($id){
        $product = Product::find($id);
        $take = $product->features;
        return $take;
    } 
    public function deleteFeature($id){
        $feature = Feature::where('id',$id)->delete();
        return "done";
    }
}
