<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index(){
        return view('owner.index');
    }

    public function manageUser(){
        $users = User::paginate(10);
        return view('owner.manageUser',compact('users'));
    }

    public function toggle(){
        $user = User::find(Input::get('id'));
        if($user->hasRole('member')){
            $user->roles()->detach(3);
            $user->detachRole(3);
        }
        else {
            $user->attachRole(3);
        }
        return redirect()->back();
    }

    public function adminToggle(){
        $user = User::find(Input::get('id'));
        if($user->hasRole('admin')){
            $user->roles()->detach(2);
            $user->detachRole(2);
        }
        else {
            $user->attachRole(2);
        }
        return redirect()->back();
    }

    public function searchUser(){
        $text = Input::get('text');
        if(is_null($text)||empty($text)){
            return  redirect('/owner/user');
        }
        $users = \Searchy::users('name')->query($text)->get();;
        $data = ['u'=>$users,'s'=>$text ];
        return view('owner.userResult',compact('data'));
    }
}
