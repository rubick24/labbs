<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index')->withCategorys(Category::all());
    }

    public function detail($name){
        return view('category.detail')->withCategory(Category::where('name',$name)->first());
    }
}
