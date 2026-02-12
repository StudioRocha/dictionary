@extends('layouts.app') @section('css')
<link rel="stylesheet" href="{{ asset('css/dictionary/create.css') }}" />
@endsection @section('content')
<div class="main">
    <div class="dictionary-register">
        <h2 class="dictionary-register__title">辞書を登録</h2>

        {{-- 入力エラーがある場合の表示（フォーム上部） --}}
        @if ($errors->any())
        <div class="alert alert--error">
            <ul>
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- 成功メッセージ（登録完了時） --}}
        @if (session('success'))
        <div class="alert alert--success">
            {{ session("success") }}
        </div>
        @endif

        {{-- 登録フォーム（POST /dictionaries） --}}
        <form method="POST" action="{{ route('dictionary.store') }}" novalidate>
            @csrf
            {{-- 入力欄：キーワード（最大10文字、必須） --}}
            <div class="form-group">
                <label for="keyword">キーワード</label>
                <input
                    id="keyword"
                    name="keyword"
                    class="input"
                    value="{{ old('keyword') }}"
                    required
                />
            </div>

            {{-- 入力欄：説明（最大50文字、必須） --}}
            <div class="form-group">
                <label for="description">説明</label>
                <textarea
                    id="description"
                    name="description"
                    class="textarea"
                    rows="6"
                    required
                    >{{ old("description") }}</textarea
                >
            </div>

            {{-- 送信ボタン --}}
            <div class="form-actions">
                <button type="submit" class="btn btn--primary">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
