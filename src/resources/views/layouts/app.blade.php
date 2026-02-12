<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>辞書アプリ</title>

        <!-- リセットCSS（ブラウザ差異の吸収） -->
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

        <!-- 共通CSS（ヘッダー/フッター/レイアウトなど） -->
        <link rel="stylesheet" href="{{ asset('css/common.css') }}" />

        <!-- ページ個別のCSS（各Bladeの@section('css')で差し込み） -->
        @yield('css')
    </head>

    <body class="layout">
        <!-- 🔼 ヘッダー（全ページ共通ナビ） -->
        <header class="header">
            <div class="header__inner">
                <h1 class="header__logo">
                    <!-- アプリ名：常に検索一覧へ戻るリンク -->
                    <a href="{{ route('dictionary.index') }}">📚 辞書アプリ</a>
                </h1>

                <nav class="header__nav">
                    {{-- いつでも見せたい：検索画面へのリンク（今いるページなら非表示） --}}
                    @if (!Route::is('dictionary.index'))
                    <a
                        href="{{ route('dictionary.index') }}"
                        class="header__link"
                        >辞書一覧/検索画面へ</a
                    >
                    @endif @auth
                    {{-- ログイン中だけ：登録画面へのリンク（今いるページなら非表示） --}}
                    @if (!Route::is('dictionary.create'))
                    <a
                        href="{{ route('dictionary.create') }}"
                        class="header__link"
                        >登録画面へ</a
                    >
                    @endif

                    {{-- ログアウト（POST）。下に現在のユーザー名を表示 --}}
                    <div class="header__account">
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="header__form"
                            style="display: inline"
                        >
                            @csrf
                            <button
                                type="submit"
                                class="header__link header__button"
                            >
                                ログアウト
                            </button>
                        </form>
                        <div class="header__user">
                            user：{{ auth()->user()->name }}
                        </div>
                    </div>
                    @endauth @guest
                    {{-- 未ログイン時：ログイン/新規登録 --}}
                    @if (!Route::is('login'))
                    <a href="{{ route('login') }}" class="header__link"
                        >ログイン</a
                    >
                    @endif @if (!Route::is('register'))
                    <a href="{{ route('register') }}" class="header__link"
                        >新規登録</a
                    >
                    @endif @endguest
                </nav>
            </div>
        </header>

        <!-- 🔽 メインコンテンツ（各ページの中身を差し込む） -->
        <main class="main">@yield('content')</main>


        <!-- JS読み込み（各Bladeの@section('js')で差し込み） -->
        @yield('js')
    </body>
</html>
