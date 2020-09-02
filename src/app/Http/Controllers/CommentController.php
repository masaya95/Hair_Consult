<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Post;
use App\PostLike;
use Auth;

class CommentController extends Controller
{
    public function create(Request $request){
      $id = $request->input('post_id');
      $item = Post::find($id);

      $comment = new Comment;
      $form = $request->all();
      unset($form['_token']);
      $comment->fill($form)->save();

      $postlikes = $item->post_likes()->where('user_id', Auth::id())->first();

      return view('post.show', compact('item', 'id', 'postlikes'));
    }
}
