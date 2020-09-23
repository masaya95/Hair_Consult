<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\CommentLike;
use App\Post;
use App\PostLike;
use Auth;

class Comment_LikeController extends Controller
{
  public function create(Request $request, $id)
  {
    $item = Post::find($id);

    $comment_like = new CommentLike;
    $form = $request->all();
    unset($form['_token']);
    $comment_like->fill($form)->save();

    $postlikes = $item->post_likes()->where('user_id', Auth::id())->first();

    // $comment_id = $request->input('comment_id');
    $comment = Comment::find($request->input('comment_id'));
    $comment->good_btn = $comment->comment_likes->count();
    $comment->save();

    return view('post.show', compact('item', 'id', 'postlikes'));
  }
}
