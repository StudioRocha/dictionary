@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="auth auth--register">
        <h2>新規登録</h2>

        @if ($errors->any())
        <div class="alert alert--error">
            <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf
            <div class="form-group">
                <label>名前</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>メール</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>パスワード確認</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit">登録</button>
        </form>
        <p><a href="{{ url('/login') }}">ログインはこちら</a></p>
    </div>
</div>
@endsection