<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{

    public function post(Request $request){
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
        return redirect('/article/'.$request->get('article'));
    }

    public function destroy($id){
        Comment::find($id)->delete();
        return redirect()->back();
    }
}
