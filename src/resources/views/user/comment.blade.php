@extends('layouts.user')

@section('content')

<div class="container">
  <div class="row">
    <!-- Topics -->
    <div class="col-md-4">
      <div class="custom-main-var rounded bg-primary text-center text-white font-weight"><div class="box-center text-nowrap">悩み,記事を投稿・探す</div></div>

      <div class="nav flex-column nav-pills custom-nav-var" aria-orientation="vertical">
        <a class="nav-item nav-link rounded custom-sub-nav text-center" href="/post/article">悩み,記事の投稿</a>
        <form action="/post/search/keyword" method="POST" class="nav-link rounded custom-sub-nav text-center">
          @csrf
          <p class="text-center">悩みを探す</p>

          <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="検索キーワード" aria-label="検索キーワード" aria-describedby="dasic-addon1">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">検索</button>
            </div>
          </div>

        </form>
      </div>
    </div>

    <!-- user情報 -->
    <div class="col-md-8">
      <!-- 内容 -->
      <div class="custom-main-var rounded bg-primary text-center text-nowrap"><div class="box-center text-white font-weight text-nowrap">マイページ</div></div>

      <div class="card custom-card">
        <div class="card-header">
          <div class="float-left text-left font-weight">{{ $auth->name }}</div>
          <div class="text-right">
            <span class="rounded bg-warning category-icon font-weight">
              @if($auth->select_rank == "general")
                一般
              @elseif($auth->select_rank == "hairdresser")
                美容師
              @elseif($auth->select_rank == "barber")
                理容師
              @endif
            </span>
          </div>
        </div>

        <div class="card-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th scope="row">性別</th>
                <td>{{ $auth->gender }}</td>
              </tr>
              <tr>
                <th scope="row">年齢</th>
                <td>{{ $auth->age }}</td>
              </tr>
              @if ($auth->select_rank != "general")
              <tr>
                <th scope="row">美容室名</th>
                <td>{{ $auth->salon_name }}</td>
              </tr>
              <tr>
                <th scope="row">美容室のURL</th>
                <td>{{ $auth->salon_url }}</td>
              </tr>
              @endif
            </tbody>
          </table>
          <div class="col-md-6 offset-md-4 text-center">
              <button class="btn btn-primary">
                <a href="/user/edit/{{ $auth->id }}" class="font-weight-bold text-white">アカウント編集</a>
              </button>
          </div>
        </div>
      </div>

      <div class="card custom-card">
        <div class="card-header">
          <div class="rounded bg-warning text-center font-weight">{{ $auth->name }}のコメントした記事</div>
          <nav class="nav nav-pills nav-justified custom-nav-var">
            <a class="nav-item nav-link rounded text-nowrap custom-sub-nav" href="/user/{{ $auth->id }}">投稿記事</a>
            <a class="nav-item nav-link rounded text-nowrap custom-sub-nav" href="/user/like/{{ $auth->id }}">いいね</a>
            <a class="nav-item nav-link rounded text-nowrap custom-sub-nav" href="/user/comment/{{ $auth->id }}">コメント</a>
          </nav>
        </div>

        <div class="card-body">
        @if(count($comments) > 0)
          @foreach($comments as $comment)
            <div class="card custom-card">
              <div class="card-header">
                <span class="rounded bg-warning category-icon">{{ $comment->post->category }}</span>
              </div>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="/post/{{ $comment->post->id }}" class="alert-link">{{ $comment->post->title }}</a>
                </h4>
                <div class="box">
                  <p class="card-text">
                    {{ $comment->post->body }}
                  </p>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">コメント📣({{ $comment->post->comments->count() }})　いいね✌️({{ $comment->post->good_btn }})</br>
                <span class="text-muted">投稿時間：{{ $comment->post->created_at }}</span></div>
              </div>
            </div>
          @endforeach
          {{ $comments->links() }}
        @else
          <div>コメントした記事がありません</div>
        @endif
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
