<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
    public function user($id){
        if(User::find($id)){
            return view('user.profile')->withUser(User::find($id));
        }
        else return redirect('article');

    }

    public function settings(){
        if(Auth::check()){
            return view('user.settings')->withUser(Auth::user());
        }
        else return redirect('login');
    }

    public function messages(){
        if (Auth::check()){
            return view('user.messages')->withUser(Auth::user());
        }
    }
}
