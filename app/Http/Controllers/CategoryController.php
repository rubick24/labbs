<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
        $categorys = Category::all();
        return view('category.index',compact('categorys'));
    }

    public function detail($name){
        $category = Category::where('name',$name)->first();
        return view('category.detail',compact('category'));
    }
}
