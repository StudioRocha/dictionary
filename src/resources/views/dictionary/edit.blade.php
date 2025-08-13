@extends('layouts.app')

@section('content')
<div class="main">
    <div class="dictionary-edit">
        <h2 class="dictionary-edit__title">辞書を編集</h2>

        @if ($errors->any())
        <div class="alert alert--error">
            <ul>
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('dictionary.update', $dictionary) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="keyword">キーワード</label>
                <input id="keyword" name="keyword" class="input" value="{{ old('keyword', $dictionary->keyword) }}" required>
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea id="description" name="description" class="textarea" rows="6" required>{{ old('description', $dictionary->description) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection


