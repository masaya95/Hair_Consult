@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('記事情報変更') }}</div>

          <div class="card-body">
            <!-- 投稿フォーム -->
            <form action="/post/edit/{{ $post->id }}" method="POST">
                @csrf

                <!-- value仮入れ(Userモデルとリレーションするのに必要) -->
                <input type="hidden" name="user_id" value="{{ $post->user_id }}">

                <div class="form-group row">
                  <label for="category" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('カテゴリー') }}</label>

                  <div class="col-md-6">

                    @if($errors->has('category'))
                        <div class="error_msg text-danger font-weight-bold">{{ $errors->first('category') }}</div>
                    @endif

                    <select class="custom-select" name='category'>
                      <option selected value="{{ $post->category }}">{{ $post->category }}</option>
                      <option value="ダメージ">ダメージ</option>
                      <option value="クセ">クセ</option>
                      <option value="ツヤ">ツヤ</option>
                      <option value="薄毛">薄毛</option>
                      <option value="育毛">育毛</option>
                      <option value="ボリューム">ボリューム</option>
                      <option value="色落ち">色落ち</option>
                      <option value="パサつき">パサつき</option>
                      <option value="乾燥">乾燥</option>
                      <option value="匂い">匂い</option>
                      <option value="ベタつき">ベタつき</option>
                      <option value="その他">その他</option>
                    </select>

                  </div>
                </div>

                <div class="form-group row">
                  <label for="title" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('タイトル') }}</label>

                  <div class="col-md-6">

                    @if($errors->has('title'))
                        <div class="error_msg text-danger font-weight-bold">{{ $errors->first('title') }}</div>
                    @endif
                    <input type="text" class="form-control" name="title" placeholder="タイトル" value="{{ $post->title }}">

                  </div>
                </div>

                <div class="form-group row">
                  <div class="container">
                    <div class="row">
                      <label for="body" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('記事内容') }}</label>
                    </div>

                    <div class="row justify-content-center">
                      <div class="col-md-8 col-lg-7">

                        @if($errors->has('body'))
                            <div class="error_msg text-danger font-weight-bold">{{ $errors->first('body') }}</div>
                        @endif
                        <div>
                            <textarea id="textarea" class="form-control" name="body" placeholder="本文">{{ $post->body }}</textarea>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="good_btn" value="0">

                <div class="form-group row mb-0 text-center">

                  <button type="submit" class="btn btn-primary mx-auto d-block">
                      {{ __('投稿') }}
                  </button>

                </div>

            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
