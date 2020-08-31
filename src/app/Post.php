<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
      'user_id',
      'category',
      'title',
      'body',
      'good_btn',
  ];

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  public function post_likes()
  {
    return $this->hasMany('App\PostLike');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
