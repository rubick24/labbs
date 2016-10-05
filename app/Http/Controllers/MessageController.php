<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $messages[0] = Message::read(\Auth::id(),false)->toArray();
        $messages[1] = Message::read(\Auth::id(),true)->toArray();
        foreach (Message::read(\Auth::id(),false) as $message){
            $message->read = true;
            $message->save();
        }
        $user = \Auth::user();
        return view('user.messages',compact('messages','user'));
    }

    public function create(){
        $user = User::find(Input::get('id'));
        return view('user.sendMessage',compact('user'));
    }

    public function send(Request $request){
        $this->validate($request, [
            'id' => 'required|exists:users,id',
            'content' => 'required',
        ]);
        $message = new Message();
        $message -> user_id = $request->get('id');
        $message -> sender_id = \Auth::id();
        $message ->content = $request->get('content');
        $message ->save();
        return redirect('/user/'.$request->get('id'));
    }
}
