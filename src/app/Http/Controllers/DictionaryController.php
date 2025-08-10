<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictionary;

class DictionaryController extends Controller
{
    // ❶ 一覧（公開）
    // app/Http/Controllers/DictionaryController.php

    public function index()
    {
        // ユーザー名を一緒に取得（N+1回避）
        $dictionaries = \App\Models\Dictionary::with('user:id,name')
            ->latest()                 // created_at desc
            ->paginate(10);            // お好みで
        // 修正後
        return view('dictionary.index', compact('dictionaries'));
    }

    // ❷ 新規作成フォーム（要ログイン）
    public function create()
    {
        return view('dictionary.create'); // ← 統一
    }

    // ❸ 保存（要ログイン）
    public function store(\App\Http\Requests\DictionaryStoreRequest $request)
    {
        $data = $request->validated(); // ['keyword','description']

        $entry = new \App\Models\Dictionary();
        $entry->user_id     = auth()->id();
        $entry->keyword     = $data['keyword'];
        $entry->description = $data['description'];
        $entry->save();

        // ✅ トップに戻さず、作成ページにとどまってフラッシュメッセージを表示
        return redirect()
            ->route('dictionary.create')     // ← ここを index から create に変更
            ->with('success', '登録しました'); // Blade の session('success') が拾う
            
    }


    // ❹ 編集（要ログイン）
    public function edit(\App\Models\Dictionary $dictionary)
    {
        $this->authorize('update', $dictionary);
        return view('dictionary.edit', compact('dictionary'));
    }

    // ❺ 更新（要ログイン）
    public function update(\App\Http\Requests\DictionaryUpdateRequest $request, \App\Models\Dictionary $dictionary)
    {
        $this->authorize('update', $dictionary);
        $validated = $request->validated();

        $dictionary->keyword = $validated['keyword'];
        $dictionary->body    = $validated['body'];
        $dictionary->save();

        return redirect()
            ->route('dictionary.index')
            ->with('success', '更新しました');
    }

    // ❻ 削除（要ログイン）
    public function destroy(\App\Models\Dictionary $dictionary)
    {
        $this->authorize('delete', $dictionary);
        $dictionary->delete();

        return back()->with('success', '削除しました');
    }
}
