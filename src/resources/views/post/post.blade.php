@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
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

    <!-- main -->
    <div class="col-md-8">
      <div class="custom-main-var rounded bg-primary text-center text-nowrap"><div class="box-center text-white font-weight text-nowrap">記事一覧</div></div>

      <nav class="nav nav-pills nav-justified custom-nav-var">
        <a class="nav-item nav-link rounded text-nowrap custom-sub-nav" href="/post/topics/rank/{{ $category }}">人気ランキング</a>
        <a class="nav-item nav-link rounded text-nowrap custom-sub-nav" href="/post/topics/news/{{ $category }}">新着投稿</a>
      </nav>

      <!-- 記事描画部分 -->
      @if(count($items) > 0)
        @foreach($items as $item)
          <!-- <div class="card w-100 custom-card"> -->
          <div class="card custom-card">
            <div class="card-header">
              <span class="float-left rounded bg-warning category-icon">{{ $item->category }}</span>
              <span class="float-right"><a href="/other/{{ $item->user->id }}">{{ '@' . $item->user->name }}</a></span>
            </div>
            <div class="card-body">
              <h4 class="card-title">
                <a href="/post/{{ $item->id }}" class="alert-link">{{ $item->title }}</a>
              </h4>
              <div class="box">
                <p class="card-text">
                  {{ $item->body }}</br><a href="/post/{{ $item->id }}" class="alert-link">>>詳しく見る</a>
                </p>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">コメント📣({{ $item->comments->count() }})　いいね✌️({{ $item->good_btn }})</br>
              <span class="text-muted">投稿時間：{{ $item->created_at }}</span></div>
            </div>
          </div>
        @endforeach
        {{ $items->links() }}
      @else
        <div class="text-center mt-3">投稿記事がありません</div>
      @endif


    </div>
  </div>
</div>

@endsection
