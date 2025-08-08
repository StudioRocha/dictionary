<?php

use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Route;

// 🔎 公開：検索一覧
Route::get('/', [DictionaryController::class, 'index'])->name('dictionary.index');

// ✅ 要ログイン
Route::middleware('auth')->group(function () {
    // 辞書の新規作成（画面・保存）
    Route::get('/dictionaries/create', [DictionaryController::class, 'create'])->name('dictionary.create');
    Route::post('/dictionaries',        [DictionaryController::class, 'store'])->name('dictionary.store');

    // 編集・更新・削除
    Route::get('/dictionaries/{dictionary}/edit',  [DictionaryController::class, 'edit'])->name('dictionary.edit');
    Route::put('/dictionaries/{dictionary}',       [DictionaryController::class, 'update'])->name('dictionary.update');
    Route::delete('/dictionaries/{dictionary}',    [DictionaryController::class, 'destroy'])->name('dictionary.destroy');
});
