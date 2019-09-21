<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class UserController extends Controller
{
    public function getuser(){
        $user = User::where('role','user')->get();
        return $user;
    }
    public function index(){
        return redirect('/home');
    }
    public function logged(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return "done";  
            index();
        }
    }
    public function reg(){
        User::create([
            'name' => request('name'),
            'password' => bcrypt(request('password')),
            'email' => request('email')
        ]);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {
            return "done";
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
