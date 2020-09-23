<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PostLike;
use App\Post;
use Auth;
use App\CommentLike;

class Post_LikeController extends Controller
{
  public function create(Request $request, $id)
  {
    $item = Post::find($id);

    // post_likesへinsert処理
    $post_like = new PostLike;
    $form = $request->all();
    unset($form['_token']);
    $post_like->fill($form)->save();

    $postlikes = $item->post_likes()->where('user_id', Auth::id())->first();

    // posts tableのgood_btnへupdate処理
    $item->good_btn = $item->post_likes->count();
    $item->save();

    return view('post.show', compact('item', 'id', 'postlikes'));
  }
}
