@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="dictionary-search">
        <h1 class="dictionary-search__title">📚 辞書検索画面</h1>
        <p class="dictionary-search__text">ここに検索フォームと結果一覧が表示されます</p>
    </div>
</div>
@endsection