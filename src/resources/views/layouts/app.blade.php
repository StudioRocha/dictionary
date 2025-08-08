<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>辞書アプリ</title>

    <!-- リセットCSS -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    <!-- ページ個別のCSS -->
    @yield('css')
</head>

<body class="layout">

    <!-- 🔼 ヘッダー -->
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">
                <a href="{{ route('dictionary.index') }}">📚 辞書アプリ</a>
            </h1>

            <nav class="header__nav">
                {{-- いつでも見せたい：検索画面へのリンク（今いるページなら非表示） --}}
                @if (!Route::is('dictionary.index'))
                <a href="{{ route('dictionary.index') }}" class="header__link">辞書一覧/検索画面へ</a>
                @endif

                @auth
                {{-- ログイン中だけ：登録画面へのリンク（今いるページなら非表示） --}}
                @if (!Route::is('dictionary.create'))
                <a href="{{ route('dictionary.create') }}" class="header__link">登録画面へ</a>
                @endif

                {{-- ログアウト（POST） --}}
                <form method="POST" action="{{ route('logout') }}" class="header__form" style="display:inline">
                    @csrf
                    <button type="submit" class="header__link header__button">ログアウト</button>
                </form>
                @endauth

                @guest
                {{-- 未ログイン時：ログイン/新規登録 --}}
                @if (!Route::is('login'))
                <a href="{{ route('login') }}" class="header__link">ログイン</a>
                @endif
                @if (!Route::is('register'))
                <a href="{{ route('register') }}" class="header__link">新規登録</a>
                @endif
                @endguest
            </nav>
        </div>
    </header>

    <!-- 🔽 メインコンテンツ -->
    <main class="main">
        @yield('content')
    </main>

    <!-- ⬇ フッター -->
    <footer class="footer">
        <p class="footer__text">© {{ date('Y') }} 辞書アプリ</p>
    </footer>

    <!-- JS読み込み -->
    @yield('js')
</body>

</html>