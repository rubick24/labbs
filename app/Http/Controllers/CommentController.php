<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkpermission')->only('destroy');
        $this->middleware(['role:member|owner']);
    }

    public function post(Request $request){

        $this->validate($request, [
            'comment' => 'required',
            'article' => 'required|exists:articles,id'
        ]);
        $comment = new Comment();
        $comment->article_id = $request->get('article');
        $comment->user_id = \Auth::id();
        $comment->content = $request->get('comment');
        $comment->save();
        \Log::info('New Comment',[
            'comment_id'=>$comment->id,
            'user_id'=>$comment->user_id,
            'article_id'=>$comment->article_id,
            'content' => $comment->content,
        ]);
        return redirect('/article/'.$request->get('article'));
    }

    public function destroy($id){
        $comment =Comment::find($id);
        \Log::notice('Delete comment',[
            'comment_id'=>$comment->id,
            'user_id'=>$comment->user_id,
            'article_id'=>$comment->article_id,
            'content' => $comment->content,
        ]);
        $comment->delete();
        return redirect()->back();
    }

}
