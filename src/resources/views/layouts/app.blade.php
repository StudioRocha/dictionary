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
            <h1 class="header__logo"><a href="{{ route('dictionary.index') }}">📚 辞書アプリ</a></h1>
            <nav class="header__nav">
                @if (!Route::is('dictionary.index'))
                <a href="{{ route('dictionary.index') }}" class="header__link">検索画面へ</a>
                @endif

                @if (!Route::is('dictionary.create'))
                <a href="{{ route('dictionary.create') }}" class="header__link">登録画面へ</a>
                @endif
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