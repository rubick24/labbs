<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function sender(){
        return $this->belongsTo('App\User','sender_id','id');
    }

    public static function messages($id){
        //$messages = \DB::table('messages')->where('user_id',$id);
        //$messages = \DB::table('messages')->where('sender_id',$id)->union($messages)->orderBy('created_at','id')->get();
        //$messages = \DB::select('select * from messages where user_id = ? or sender_id = ?', [$id,$id]);
        $messages = \DB::table('messages')->where('user_id',$id)->orWhere('sender_id',$id)->orderBy('created_at','id')->get();
        return $messages;
    }

    public static function read($id,$true=true){
        return Message::where('user_id',$id)->where('read',$true)->get();
    }

}
