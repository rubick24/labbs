<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;

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
}
