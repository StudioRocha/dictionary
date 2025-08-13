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

                <select name="sort">
                    <option value="new" {{ request('sort', 'new') === 'new' ? 'selected' : '' }}>新着順</option>
                    <option value="old" {{ request('sort') === 'old' ? 'selected' : '' }}>古い順</option>
                    <option value="keyword_asc" {{ request('sort') === 'keyword_asc' ? 'selected' : '' }}>キーワード A→Z</option>
                    <option value="keyword_desc" {{ request('sort') === 'keyword_desc' ? 'selected' : '' }}>キーワード Z→A
                    </option>
                </select>

                <button type="submit">検索</button>
            </form>

            {{-- 一覧 --}}
            <ul class="dict-list">
                @forelse ($dictionaries as $d)
                    {{-- 各行に本人判定を追加 --}}
                    @php $isMine = auth()->check() && $d->user_id === auth()->id(); @endphp
                    <li class="dict-item{{ $isMine ? ' dict-item--mine' : '' }}" data-id="{{ $d->id }}">
                        <div class="dict-item__view">
                            <div class="dict-item__actions">
                                @if ($isMine)
                                    <button type="button" class="dict-edit-toggle button-link">編集</button>
                                    <form method="POST" action="{{ route('dictionary.destroy', $d) }}"
                                        class="dict-delete-form" onsubmit="return confirm('この辞書を削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-link button-link--danger">削除</button>
                                    </form>
                                @endif
                            </div>
                            <span class="dict-item__date">{{ $d->created_at->format('Y/m/d') }}</span>
                            <span class="dict-item__user">{{ optional($d->user)->name ?? '退会ユーザー' }}</span>
                            <span class="dict-item__keyword">{{ $d->keyword }}</span>
                            <div class="dict-item__desc">
                                {{ $d->description }}
                            </div>
                        </div>

                        @if ($isMine)
                            <form class="dict-item__edit" action="{{ route('dictionary.update', $d) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="edit-fields">
                                    <label class="edit-field">
                                        <span class="edit-label">キーワード</span>
                                        <input type="text" name="keyword" value="{{ old('keyword', $d->keyword) }}" />
                                    </label>
                                    <label class="edit-field">
                                        <span class="edit-label">説明</span>
                                        <textarea name="description">{{ old('description', $d->description) }}</textarea>
                                    </label>
                                </div>
                                <div class="edit-actions">
                                    <button type="submit" class="edit-save">保存</button>
                                    <button type="button" class="edit-cancel">キャンセル</button>
                                </div>
                            </form>
                        @endif
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

@section('js')
    <script>
        document.addEventListener('click', function(e) {
            var toggleBtn = e.target.closest('.dict-edit-toggle');
            if (toggleBtn) {
                var item = toggleBtn.closest('.dict-item');
                if (item) item.classList.add('is-editing');
                return;
            }
            var cancelBtn = e.target.closest('.edit-cancel');
            if (cancelBtn) {
                var item2 = cancelBtn.closest('.dict-item');
                if (item2) item2.classList.remove('is-editing');
                return;
            }
        });
    </script>
@endsection
