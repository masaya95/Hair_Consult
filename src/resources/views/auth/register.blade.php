@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規会員登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('ニックネーム') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('性別') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6" style="padding-top: 8px">
                                <input id="male" type="radio"  name="gender" value="男性">
                                <label for="male">男性</label>

                                <input id="female" type="radio" name="gender" value="女性">
                                <label for="female">女性</label>


                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('年齢') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6">
                                <input id="age" type="number" min="1" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select_rank" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('美容師または理容師ですか？') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6" style="padding-top: 8px">
                                <input id="general" type="radio"  name="select_rank" value="general">
                                <label for="general">違う</label>


                                <input id="hairdresser" type="radio" name="select_rank" value="hairdresser">
                                <label for="hairdresser">美容師</label>

                                <input id="barber" type="radio" name="select_rank" value="barber">
                                <label for="barber">理容師</label>


                                @error('select_rank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salon_name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('美容室名') }}<span class="badge badge-primary">任意</span></label>

                            <div class="col-md-6">
                                <input id="salon_name" type="text" class="form-control @error('salon_name') is-invalid @enderror" name="salon_name" value="{{ old('salon_name') }}" autocomplete="salon_name" autofocus>

                                @error('salon_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salon_url" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('美容室のURL(予約サイト可)') }}<span class="badge badge-primary">任意</span></label>

                            <div class="col-md-6">
                                <input id="salon_url" type="text" class="form-control @error('salon_url') is-invalid @enderror" name="salon_url" value="{{ old('salon_url') }}" autocomplete="salon_url" autofocus>

                                @error('salon_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('メールアドレス') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('パスワード') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('パスワード(確認用)') }}<span class="badge badge-danger">必須</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('アカウント登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
