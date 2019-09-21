<?php
namespace App\Http\Controllers;
use Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(){
      $caseid = request('caseid');
      $quant = request('quant');
      $take = Product::find($caseid);
      if($quant <= $take->stock)
      {
        Cart::add($caseid, $take->name, $quant , $take->price , ['image' => $take->image] );
        $notification = array(
            'message' => 'Product Added To Cart!!',
            'alert-type' => 'success'
        );
      }else{
        $notification = array(
            'message' => 'Not Such Amount Of Product Available',
            'alert-type' => 'error'
        );
     }
      return back()->with($notification);
    }

    public function showCart(){
        return view('show_cart');
    }
    public function deleteItem($id){
        Cart::remove($id);
        $notification = array(
            'message' => 'Item Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return redirect('/cart/showCart')->with($notification);
    }
    public function update(){
        $arrayQty = request('qty');
        $count = 0;
        foreach(Cart::content() as $took)
        {
            $cart_item = null;
            $take_id = null;
             $cart_item = $took->name;
            $take_id  = $arrayQty[$took->rowId];               
                $pro_stock = Product::find($took->id);
            if($take_id > $pro_stock->stock)
            {
                $count+= 1;            
            }
            else{
                Cart::update($took->rowId, ['qty' => $take_id]);
            }
        }
        if($count >= 1)
        {
            $notification = array(
                'message' =>'Sorry !! No Such Amount Of Product Available',
                'alert-type' => 'error'
            );
            
        }
        else{
            $notification = array(
                'message' => 'Cart Updated Successfully',
                'alert-type' => 'success'
            );
        }
        return redirect()->back()->with($notification);
    }
}
