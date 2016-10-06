<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(6);
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::guest())
            return redirect('/login');
        if(\Auth::user()->hasRole('member')||\Auth::user()->hasRole('owner')){
            $categorys = Category::all();
            return view('article.create',compact('categorys'));
        }
        else abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::guest())
            return redirect('/login');
        if(\Auth::user()->hasRole('member')||\Auth::user()->hasRole('owner')) {
            $this->validate($request, [
                'title' => 'required|max:255',
                'content' => 'required',
                'category' => 'required|exists:categories,id'
            ]);
            Storage::put('public/article/' . md5($request->get('title')) . '.md', $request->get('content'));
            //$path = Storage::putFileAs('article', $request->get('content'),md5($request->get('title')).'.md');
            $article = new Article();
            $article->title = $request->get('title');
            $article->user_id = \Auth::user()->id;
            $article->url = 'public/article/' . md5($article->title) . '.md';
            $article->category_id = $request->get('category');
            $article->stat = 0;
            $article->upper = 0;
            $article->save();
            return redirect('/article');
        }
        else abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Article::find($id)){
            return view('article.view')->withArticle(Article::find($id));
        }
        else abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::id() == Article::find($id)->user_id||\Auth::user()->hasRole('owner')||\Auth::user()->hasRole('admin')){
            foreach (Article::find($id)->comments as $comment){
                $comment->delete();
            }
            Article::find($id)->delete();
            return redirect('/article');
        }
        else return abort(403);

    }

    public function search(){
        $text = Input::get('text');
        if(is_null($text)||empty($text)){
            return  redirect('/article');
        }
        $users = \Searchy::users('name')->query($text)->get();
        $articles = \Searchy::driver('simple')->articles('title')->query($text)->get();
        $data = ['u'=>$users,'a'=>$articles,'s'=>$text ];
        return view('result',compact('data'));
    }


}
