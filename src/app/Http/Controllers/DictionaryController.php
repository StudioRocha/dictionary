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
		// 一覧用クエリを作成（ユーザー名も同時に取得してN+1を回避）
		$query = \App\Models\Dictionary::with('user:id,name');

		if (request()->filled('q')) {
			$q = request('q');
			// 検索条件：キーワード、説明、ユーザー名の部分一致
			$query->where(function ($sub) use ($q) {
				$sub
					// キーワードに部分一致
					->where('keyword', 'like', "%$q%")
					// 説明文に部分一致
					->orWhere('description', 'like', "%$q%")
					// 投稿者のユーザー名に部分一致（userリレーション経由）
					->orWhereHas('user', function ($userQuery) use ($q) {
						$userQuery->where('name', 'like', "%$q%");
					});
			});
		}

		// 並び替え
		$sort = request('sort', 'new');
		switch ($sort) {
			case 'old':
				$query->orderBy('created_at', 'asc');
				break;
			case 'keyword_asc':
				$query->orderBy('keyword', 'asc');
				break;
			case 'keyword_desc':
				$query->orderBy('keyword', 'desc');
				break;
			case 'new':
			default:
				$query->orderBy('created_at', 'desc');
				break;
		}

		// ページネーション（クエリ文字列を引き継ぎ）
		$dictionaries = $query->paginate(10)->appends(request()->query());
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
		$dictionary->description = $validated['description'];
        $dictionary->save();

        return redirect()
            ->route('dictionary.index')
            ->with('success', '更新しました');
    }

    // ❻ 削除（要ログイン）
    public function destroy(\App\Models\Dictionary $dictionary)
    {
        $this->authorize('delete', $dictionary);
		// 物理削除（SoftDeletes未使用のため）
		$dictionary->delete();

        return back()->with('success', '削除しました');
    }
}
