<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'post_id',
      'user_id',
      'body',
      'good_btn',
    ];

    public function post()
    {
      return $this->belongsTo('App\Post');
    }

    public function comment_likes()
    {
      return $this->hasMany('App\CommentLike');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
