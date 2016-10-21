<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:member|owner'])->except('user','active');;
    }

    public function user($id){
        return view('user.profile')->withUser(User::find($id));
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
        return view('user.settings')->withUser(Auth::user());
    }

}
