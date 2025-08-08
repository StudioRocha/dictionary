@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="auth auth--login">
        <h2>ログイン</h2>

        @if ($errors->any())
        <div class="alert alert--error">
            <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="form-group">
                <label>メール</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="remember"> ログイン状態を保持</label>
            </div>
            <button type="submit">ログイン</button>
        </form>
        <p><a href="{{ url('/register') }}">新規登録はこちら</a></p>
    </div>
</div>
@endsection