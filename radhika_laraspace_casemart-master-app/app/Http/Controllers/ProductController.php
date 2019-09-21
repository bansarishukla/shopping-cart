<?php

namespace App\Http\Controllers;

use App\Product;
use App\Phone;
use App\Category;
use App\Feature;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $took_product = array();
        $product = Product::all();
        foreach($product as $pro){
            $phone_mate = $pro->phone_id;
            $phone = Phone::where('id',$phone_mate)->pluck('phone');
            $var = array(
               'id' => $pro->id,
               'name' => $pro->name,
               'price' => $pro->price,
               'stock' => $pro->stock,
               'image' => $pro->image,
               'phone' => $phone,
               'category' => $pro->categories
           );
           $took_product[] = $var;
           $phone_mate = null;
           $phone = null;
        }
        return $took_product;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $product = Product::create([
            'name' => request('product_name'),
            'phone_id' => request('phone_model'),
            'price' => request('price'),
            'stock' => request('stock'),
            'image' => request('image')
         ]);
        $take_id =$product->id;
        $take_data = Product::find($take_id);
        $tookPhone = request('category');
        $take_data->categories()->sync($tookPhone); 
        return "done";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Product::where('id',$id)->delete();
        return "deleted successfully";
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

    public function caseDetail($id){
        $product  = Product::find($id);
        $phone_id = $product->phone_id;
        $phone = Phone::find($phone_id);
        $category = $product->categories;
        return view('case_detail',compact('product','phone','category'));
    } 
}