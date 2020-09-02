<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Post;
use App\Comment;
use App\PostLike;
use Auth;

class UserController extends Controller
{
    public function index()
    {
      $id = Auth::id();
      $auth = Auth::user();

      $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

      return view('user.index', compact('auth', 'posts'));
    }

    public function like()
    {
      $id = Auth::id();
      $auth = Auth::user();

      $postlikes = PostLike::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

      return view('user.like', compact('auth', 'postlikes'));
    }

    public function comment()
    {
      $id = Auth::id();
      $auth = Auth::user();

      $comments = Comment::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

      return view('user.comment', compact('auth', 'comments'));
    }

    public function edit()
    {
      $auth = Auth::user();

      return view('user.edit', ['auth' => $auth]);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'gender' => ['required'],
        'age' => ['required', 'integer', 'min:1'],
        'select_rank' => ['required'],
        'salon_name' => ['nullable', 'string'],
        'salon_url' => ['nullable','url'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id.',id'],
      ]);
      $user = User::find($request->id);
      $form = $request->all();
      unset($form['_token']);
      $user->fill($form)->save();
      return redirect('/home');
    }
}
