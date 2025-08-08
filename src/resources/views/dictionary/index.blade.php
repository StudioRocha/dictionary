@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dictionary/index.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="dict-index">
        <div class="dict-index__head">
            <h2>検索画面</h2>
            <div class="dict-index__actions">
                <a href="{{ route('dictionary.create') }}" class="button-link">登録画面へ</a>
            </div>
        </div>

        <form action="{{ route('dictionary.index') }}" method="GET" class="dict-index__search">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="キーワードを入力…">
            <button type="submit">検索</button>
        </form>

        {{-- 一覧 --}}
        <ul class="dict-list">
            @forelse ($dictionaries as $d)
            <li class="dict-item">
                <span class="dict-item__date">{{ $d->created_at->format('Y/m/d') }}</span>
                <span class="dict-item__user">{{ optional($d->user)->name ?? '退会ユーザー' }}</span>
                <span class="dict-item__keyword">{{ $d->keyword }}</span>
                <div class="dict-item__desc">{{ $d->description }}</div>
            </li>
            @empty
            <li class="dict-item dict-item--empty">データがありません</li>
            @endforelse
        </ul>


    </div>




    {{-- ページネーション --}}
    <div class="dict-index__pager">
        {{ $dictionaries->links() }}
    </div>
</div>
@endsection