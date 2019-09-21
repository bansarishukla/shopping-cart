<?php

namespace App\Http\Controllers;
use App\Order;
use App\OrderItem;
use Cart;
use App\User;
use App\Product;
use Carbon\Carbon;
use App\Address;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  
    public function addOrder(){
        $address = Address::where('user_id',auth()->id())->get();
        return view('add_address',compact('address'));
    }

    // storing the order in the order table
    public function checkout(){
      $countAddress = Address::where('user_id',auth()->id())->count()   ;
      if($countAddress == 0 )
        {
            $notification =  array(
                'message' => 'Please Kindly Add  The Address',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
      else{
        $address_id = request('select');
        $cartCount = Cart::count();
            if($cartCount != 0){
                $order = Order::create([       
                     'user_id' => auth()->id(),
                    'total' => Cart::total(),
                    'subtotal' => Cart::subtotal(),
                    'payment_method' => 'cod', 
                ]);    
                $unpaid = Order::where('paid',0)->get();
                $id = trim($unpaid->pluck('id'),'[]');
                $pivot = Order::find($id);
                $user_id = auth()->id();
                $pivot->users()->attach($user_id);
                $pivot->addresses()->attach($address_id);
                foreach(Cart::content() as $cart)
                {
                    OrderItem::create([
                        'order_id' => $id,
                        'price' => $cart->price,
                        'name' => $cart->name,
                        'case_id' => $cart->id,
                        'quantity' => $cart->qty,
                        'image' => $cart->options->image
                    ]);
                } 
                foreach(Cart::content() as $cartItem)
                {
                    $stock = Product::where('id',$cartItem->id)->get();
                    $stock2 = trim($stock->pluck('stock'),'[]');
                    $stock1 = $stock2-$cartItem->qty;      
                    Product::where('id',$cartItem->id)->update([
                        'stock' => $stock1  
                    ]);
                    
                    Cart::remove($cartItem->rowId);
                }   
                Order::where('paid',0)->update([
                     'paid' => 1
                ]);
                return view('order_placed');

            }   
            else{
                return view('order_placed');    
            }
        }
    }

    // showing orders as per the user

    public function myorder(){
        $order = Order::where('user_id', auth()->id())->orderBy('created_at','DESC')->get();
        return view('view_order',compact('order'));
    }

    public function cancelOrder($id){
        Order::where('id',$id)->delete();
        OrderItem::where('order_id',$id)->delete();
        $notification = array(
            'message' =>"Your Order Has Been Canceled Succesfully !!",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);         
    }

    public function allorder(){
        $order = Order::all();
        $take_ar = array();
        $take_order = null;
        $take= array();
        foreach($order as $make)
        {
         $take_order = OrderItem::where('order_id',$make->id)->get();
            foreach($take_order as $do_order)
            {        
                   $user  = User::find($make->user_id);
                   $take_ar[$make->id] = array(
                        'total_price' => $make->total,
                        'payment_method' => $make->payment_method,
                        'order_id' => $make->id,
                        'user_name' => $user->name,
                        'created_at' =>$make->created_at
                   );
            }
        }
        return $take_ar;
    }
    public function getaddress($id){
        $order = Order::find($id);
        $get_address= null;
        foreach($order->addresses as $address)
        {
            $get_address = $address;
        } 
        return $get_address;
    }
    public function getproduct($id)
    {
        $order = Order::find($id);
        $i = 0 ;
        $take_item = array();
        foreach($order->orderitems as $item)
        {
            $take_item[$i] = $item;
            $i++;
        }
        return $take_item;
    }
    public function getorder($id){
        $order = Order::find($id);
        return $order;
    }
}
