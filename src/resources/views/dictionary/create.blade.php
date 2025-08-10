@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dictionary/create.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="dictionary-register">
        <h2 class="dictionary-register__title">辞書を登録</h2>

        {{-- ★ ページ専用のメッセージ表示 --}}
        @if ($errors->any())
        <div class="alert alert--error">
            <ul>
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert--success">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('dictionary.store') }}" novalidate>
            @csrf
            
            <div class="form-group">
                <label for="keyword">キーワード</label>
                <input id="keyword" name="keyword" class="input" value="{{ old('keyword') }}" required>
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea id="description" name="description" class="textarea" rows="6" required>{{ old('description') }}</textarea>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn--primary">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection