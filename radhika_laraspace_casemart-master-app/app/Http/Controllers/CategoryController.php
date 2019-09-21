<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    function  add(){
       $category = Category::create([
            'category' => request('category')
        ]);
        return $category;
    }
    function fetch_category(){
        $take = Category::all();
        return $take;
    }
    function delete_category($id){
        Category::where('id',$id)->delete();
        return "done";
    }
}