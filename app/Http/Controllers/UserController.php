<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function user($id){
        return view('user.profile')->withUser(User::find($id));
    }
}
