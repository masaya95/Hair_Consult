@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <span class="float-left rounded bg-warning category-icon">{{ $item->category }}</span>
          <span class="float-right"><a href="/other/{{ $item->user_id }}">{{ '@' . $item->user->name }}</a></span>
        </div>
        <div class="card-body">
          <h5 class="card-title font-weight-bold">{{ $item->title }}</h4>
          <p class="card-text textarea-p">{{ $item->body }}</p>
        </div>

        <!-- いいね投稿フォーム -->
        <div class="card-footer text-right">
          @if( $postlikes == null)
            <form method="POST" action="/post/{{ $id }}/postlike">
              @csrf
              <input type="hidden" name="post_id" value="{{ $id }}">

              <input type="hidden" name="user_id" value="{{ Auth::id() }}">

              <button class="btn btn-info btn-sm" type="submit">いいね✌️({{ $item->good_btn }})</button>
            </form>
            <div class="text-right text-muted">投稿時間：{{ $item->created_at }}</div>
          @else
            <button class="btn btn-light btn-sm">いいね済✌️({{ $item->good_btn }})</button>
            <div class="text-right text-muted">投稿時間：{{ $item->created_at }}</div>
          @endif
        </div>


      </div>

      <!-- コメント投稿フォーム -->
      <div class="media rounded bg-white mt-3">
        <div class="media-body p-2">
          <form method="POST" action="/post/{{ $id }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $item->id }}">

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <textarea id="textarea" class="form-control" name="body" placeholder="コメントする">{{ old('body') }}</textarea>

            <input type="hidden" name="good_btn" value=0>

            <div class="custom-media-footer text-right mt-3">
              <input class="btn btn-primary" type="submit" value="コメント投稿">
            </div>
          </form>

          <!-- コメント一覧 -->
          @foreach($item->comments as $comment)

          @if ($comment->comment_likes()->where('user_id', Auth::id())->count() > 0)
            <div class="border-top border-black mt-5">
              <div class="mt-2">
                <a href="/other/{{ $comment->user_id }}">{{ '@' . $comment->user->name }}</a>
              </div>
              <div class="mt-1">
                <p class="textarea-p">{{ $comment->body }}</p>
              </div>
              <div class="text-right mt-1">
                <button class="btn btn-light btn-sm">いいね済✌️({{ $comment->comment_likes->count() }})</button>
                <div class="text-muted">投稿時間：{{ $comment->created_at }}</div>
              </div>
            </div>
          @else
            <div class="border-top border-black mt-5">
              <div class="mt-2"><a href="/other/{{ $comment->user_id }}">{{ '@' . $comment->user->name }}</a></div>
              <div class="mt-1"><p>{{ $comment->body }}</p></div>
              <div class="text-right mt-1">
                <form method="POST" action="/post/{{ $id }}/commentlike">
                  @csrf
                  <input type="hidden" name="comment_id" value="{{ $comment->id }}">

                  <input type="hidden" name="post_id" value="{{ $id }}">

                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                  <button class="btn btn-info btn-sm" type="submit">いいね✌️({{ $comment->comment_likes->count() }})</button>
                </form>
                <div class="text-light text-muted">投稿時間：{{ $comment->created_at }}</div>
              </div>
            </div>
          @endif

          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
