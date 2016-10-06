<?php

namespace App\Http\Controllers;

use App\Article;
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
        $articles = Article::where('category_id',$category->id)->paginate(6);
        $data = ['c'=>$category,'a'=>$articles];
        return view('category.detail',compact('data'));
    }
}
