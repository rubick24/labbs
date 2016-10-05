<?php

namespace App\Http\Controllers;

use App\Message;
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

    public function unratified(){
        $result = [];
        $i=0;
        foreach (User::where('status',1)->get() as $user ){
            if ($user->hasRole('member')||$user->hasRole('owner')){
                ;
            }
            else {
                $result[$i] = $user;
                $i++;
            }
        }
        $data = ['u'=>$result,'s'=>'未批准' ];
        return view('owner.userResult',compact('data'));
    }

    public function admin(){
        $result = [];
        $i=0;
        foreach (User::where('status',1)->get() as $user ){
            if ($user->hasRole('admin')){
                $result[$i] = $user;
                $i++;
            }
        }
        $data = ['u'=>$result,'s'=>'管理员' ];
        return view('owner.userResult',compact('data'));
    }

    public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->back();
    }

    public function message(){
        return view('owner.message');
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
            'content' => 'required',
        ]);
        $sender =  \Auth::id();

        foreach ( User::all() as $user ){
            $message = new Message();
            $message ->user_id = $user->id;
            $message ->sender_id = $sender;
            $message ->content = $request->get('content');
            $message ->save();
        }

        return redirect('/owner');
    }
}
