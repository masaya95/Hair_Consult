<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- viewport meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-180265147-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-180265147-1');
    </script>
</head>
<body>
  <div id="app">
    <header class="shadow-sm sticky-top">
      <nav class="navbar navbar-expand-md navbar-light bg-white">
          <div class="container">
              <a class="navbar-brand font-weight" href="{{ url('/post') }}">
                  {{ config('app.name', 'Laravel') }}
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->
                      @guest
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                          </li>
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('新規会員登録') }}</a>
                              </li>
                          @endif
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="/user/{{ Auth::user()->id }}">
                                    {{ __('マイページ') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                              </div>
                          </li>
                      @endguest
                  </ul>
              </div>
          </div>
      </nav>
      <!-- Category Var -->
      <nav class="navbar navbar-expand-md navbar-light bg-white">
        <ul class="horizontal-list mx-auto">
          <li class="item">
            <a href="/post" class="text-info">総合</a>
          </li>
          <li class="item">
            <a href="/post/ダメージ/refine_category" class="text-danger">ダメージ</a>
          </li>
          <li class="item">
            <a href="/post/クセ/refine_category" class="text-warning">クセ</a>
          </li>
          <li class="item">
            <a href="/post/ツヤ/refine_category" class="text-body">ツヤ</a>
          </li>
          <li class="item">
            <a href="/post/薄毛/refine_category" class="text-primary">薄毛</a>
          </li>
          <li class="item">
            <a href="/post/育毛/refine_category" class="text-info">育毛</a>
          </li>
          <li class="item">
            <a href="/post/ボリューム/refine_category" class="text-danger">ボリューム</a>
          </li>
          <li class="item">
            <a href="/post/色落ち/refine_category" class="text-warning">色落ち</a>
          </li>
          <li class="item">
            <a href="/post/パサつき/refine_category" class="text-body">パサつき</a>
          </li>
          <li class="item">
            <a href="/post/乾燥/refine_category" class="text-primary">乾燥</a>
          </li>
          <li class="item">
            <a href="/post/匂い/refine_category" class="text-info">匂い</a>
          </li>
          <li class="item">
            <a href="/post/ベタつき/refine_category" class="text-danger">ベタつき</a>
          </li>
          <li class="item">
            <a href="/post/その他/refine_category" class="text-warning">その他</a>
          </li>
        </ul>
      </nav>
    </header>
    <main class="py-4 main-color">
        @yield('content')
    </main>
    <footer class="footer-color">
      <div class="container">
        <div class="text-center footer-text">
          m.o_portfolio</br>
          -髪の相談所-
        </div>
      </div>
    </footer>
  </div>
    <!-- jQuery、Popper.js、Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
