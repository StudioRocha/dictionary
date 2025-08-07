@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="dictionary-register">
    <h1 class="dictionary-register__title">📘 辞書登録</h1>

    <form action="{{ route('dictionary.store') }}" method="POST" class="dictionary-form">
        @csrf

        <div class="form-group">
            <input type="text" name="keyword" class="input" placeholder="キーワード">
        </div>

        <div class="form-group">
            <textarea name="description" class="input" placeholder="説明" rows="6">{{ old('description') }}</textarea>
        </div>

        <div class="form-group form-submit">
            <button type="submit" class="button">登録</button>
        </div>
    </form>
</div>
@endsection