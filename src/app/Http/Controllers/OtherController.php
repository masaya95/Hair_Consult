<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Comment;
use App\PostLike;
use App\CommentLike;
use Auth;

class OtherController extends Controller
{
  public function index($id)
  {
    $auth = Auth::user();

    $other = User::find($id);

    $other_posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

    return view('other.index', compact('auth', 'other', 'other_posts'));
  }

  public function like($id)
  {
    $auth = Auth::user();
    $other = User::find($id);

    $other_post_likes = PostLike::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

    $other_comment_likes = CommentLike::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

    return view('other.like', compact('auth', 'other', 'other_post_likes', 'other_comment_likes'));
  }

  public function comment($id)
  {
    $auth = Auth::user();
    $other = User::find($id);

    $other_comments = Comment::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

    return view('other.comment', compact('auth', 'other', 'other_comments'));
  }
}
