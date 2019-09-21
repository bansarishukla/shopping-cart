<?php

namespace App\Http\Controllers;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function add(){
        $this->validate(request(),[
            'name' => 'required',
            'pincode' => 'required|max:6|min:6',
            'phoneNumber' => 'required|max:10|min:10',
            'city'=> 'required',
            'state' => 'required',
            'address' => 'required'
        ]);
        Address::create([
            'name' => request('name'),
            'address' => request('address'),
            'city' => request('city'),
            'state' => request('state'),
            'pincode' => request('pincode'),
            'phone' => request('phoneNumber'),
            'user_id' => auth()->id()
        ]); 
        $notification = array(
            'message' => 'Address Added Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function delete($id){
        Address::where('id',$id)->delete();
        $notification = array(
            'message' => 'Address Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  
    }
}
