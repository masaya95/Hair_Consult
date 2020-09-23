<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\PostLike;
use Auth;
use App\CommentLike;

use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $category = $request->category;
      $keyword = null;
      $items = Post::orderBy('good_btn', 'desc')->paginate(10);
      return view('post.post', compact('category', 'keyword', 'items'));
    }

    public function news(Request $request, $category = null)
    {
      if($category === NULL){
        $items = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('post.post', compact('category', 'items'));
      }else{
        $items = Post::where('category', $category)->orderBy('created_at', 'desc')->paginate(10);
        return view('post.post', compact('category', 'items'));
      }
    }

    public function rank(Request $request, $category = null)
    {
      if($category === NULL){
        $items = Post::orderBy('good_btn', 'desc')->paginate(10);
        return view('post.post', compact('category', 'items'));
      }else{
        $items = Post::where('category', $category)->orderBy('good_btn', 'desc')->paginate(10);
        return view('post.post', compact('category', 'items'));
      }
    }

    public function refine_category(Request $request)
    {
      $category = $request->category;
      $items = Post::where('category', $category)->paginate(10);
      return view('post.post', compact('category', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function article()
    {
      return view('post.article');
    }

    public function create(Request $request)
    {
      $post = new Post;
      $form = $request->all();
      unset($form['_token']);
      $post->fill($form)->save();
      return redirect('/post');
    }

    // 検索機能
    public function search(Request $request)
    {
      $keyword = $request->keyword;
      if($keyword === NULL){
        return redirect('/post');
      }else{
        $items = Post::where('category', 'LIKE', "%$keyword%")->orWhere('title', 'LIKE', "%$keyword%")->orWhere('body', 'LIKE', "%$keyword%")->orderBy('good_btn', 'desc')->paginate(10);
        return view('post.search', compact('keyword', 'items'));
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $post = new Post;
      $form = $request->all();

      $rule = [
        'user_id' => 'integer|required',
        'category' => 'string|required',
        'title' => 'required',
        'body' => 'required',
      ];

      $message = [
        'user_id.integer' => 'System Error',
        'user_id.required' => 'System Error',
        'category.string' => 'カテゴリを選択して下さい',
        'category.required' => 'カテゴリが選択されていません',
        'title.required' => 'タイトルが入力されていません',
        'body.required' => '記事内容が入力されていません',
      ];

      $validator = Validator::make($form, $rule, $message);

      if($validator->fails()){
        return redirect('/post/article')
          ->withErrors($validator)
          ->withInput();
      }else{
        unset($form['_token']);
        $post->user_id = $request->user_id;
        $post->category = $request->category;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->good_btn = $request->good_btn;
        $post->save();
        return redirect('/post');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $item = Post::find($id);

      $auth = Auth::id();

      if(empty($item)){
        return view('post.novalue', compact('id'));
      }else{
        $comments = $item->comments;

        $postlikes = $item->post_likes()->where('user_id', Auth::id())->first();

        return view('post.show', compact('item', 'auth', 'id', 'postlikes'));
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);

      return view('post.edit', compact('post'));
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
      $this->validate($request, [
        'category' => ['required'],
        'title' => ['required', 'string', 'max:30'],
        'body' => ['required', 'string', 'max:1000'],
      ]);
      $post = Post::find($request->id);
      $form = $request->all();
      unset($form['_token']);
      $post->fill($form)->save();
      return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      $post->delete();
      return view('post.delete');
    }
}
