<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function user($id){
        if(User::find($id)&&User::find($id)->status==1){
            return view('user.profile')->withUser(User::find($id));
        }
        else return redirect()->back();
    }

    public function active(){

        $user = \App\User::find(Input::get('id'));
        if($user->token==Input::get('token')){
            $user->status = 1;
            $user->save();
            $user->roles()->attach(3);
            if(Auth::guest()) {
                Auth::login($user);
            }
            \Log::info('User actived',['id'=>$user->id,'email'=>$user->email ]);
            return redirect('/article');
        }
        else echo '激活失败';
    }

    public function avatar(Request $request,$id){
        if(Auth::guest()){
            return redirect('login');
        }
        if($id!=Auth::id()||Auth::user()->status!=1){
            return abort(403);
        }
        $this->validate($request,[
            'avatar'  =>  'required|image'
        ]);
        $path = $request->file('avatar')->store('public/avatar');
        $user = Auth::user();
        $user->avatar = substr($path,7);
        $user->save();
        \Log::info('Avatar update',['user_id'=>$user->id,'avatar'=>$user->avatar]);
        return redirect()->back();
    }

    public function update(Request $request,$id){
        if(Auth::guest()){
            return redirect('login');
        }
        if($id!=Auth::id()||Auth::user()->status!=1){
            return abort(403);
        }
        $this->validate($request,[
            'name'=> 'required|max:255',
            'bio' => 'string',
            'url'=> 'max:255',
        ]);
        $user= Auth::user();
        $user->name = $request->get('name');
        $user->bio  = $request->get('bio');
        $user->site = $request->get('url');
        $user->save();
        \Log::info('Profile update',[
            'user_id'=>$user->id,
            'name'=>$user->name,
        ]);
        return redirect('/user/'.$id);
    }

    public function settings(){
        if(Auth::check()&&Auth::user()->status==1){
            return view('user.settings')->withUser(Auth::user());
        }
        else return redirect('login');
    }

}
