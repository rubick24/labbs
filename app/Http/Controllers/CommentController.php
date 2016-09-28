<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{

    public function postComment(Request $request){
        if(\Auth::guest())
            return redirect('/login');
        $this->validate($request, [
            'comment' => 'required',
            'article' => 'required|exists:articles,id'
        ]);
        $comment = new Comment();
        $comment->article_id = $request->get('article');
        $comment->user_id = \Auth::user()->id;
        $comment->content = $request->get('comment');
        $comment->save();
        //print_r($comment);
        return redirect('/article/'.$request->get('article'));
    }
}
