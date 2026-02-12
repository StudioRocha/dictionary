<?php

namespace App\Http\Controllers;

use App\Http\Requests\DictionaryStoreRequest;
use App\Http\Requests\DictionaryUpdateRequest;
use App\Models\Dictionary;

class DictionaryController extends Controller
{
    public function index()
    {
        $query = Dictionary::with('user:id,name');

        if (request()->filled('q')) {
            $q = request('q');
            $query->where(function ($sub) use ($q) {
                $sub
                    ->where('keyword', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orWhereHas('user', function ($userQuery) use ($q) {
                        $userQuery->where('name', 'like', "%$q%");
                    });
            });
        }

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

        $dictionaries = $query->paginate(10)->appends(request()->query());

        return view('dictionary.index', compact('dictionaries'));
    }

    public function create()
    {
        return view('dictionary.create');
    }

    public function store(DictionaryStoreRequest $request)
    {
        $data = $request->validated();

        $entry = new Dictionary();
        $entry->user_id = auth()->id();
        $entry->keyword = $data['keyword'];
        $entry->description = $data['description'];
        $entry->save();

        return redirect()
            ->route('dictionary.create')
            ->with('success', '登録しました');
    }

    public function edit(Dictionary $dictionary)
    {
        $this->authorize('update', $dictionary);

        return view('dictionary.edit', compact('dictionary'));
    }

    public function update(DictionaryUpdateRequest $request, Dictionary $dictionary)
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

    public function destroy(Dictionary $dictionary)
    {
        $this->authorize('delete', $dictionary);
        $dictionary->delete();

        return back()->with('success', '削除しました');
    }
}
