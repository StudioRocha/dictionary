<?php

use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DictionaryController::class, 'index'])->name('dictionary.index');

Route::middleware('auth')->group(function () {
    Route::get('/dictionaries/create', [DictionaryController::class, 'create'])->name('dictionary.create');
    Route::post('/dictionaries', [DictionaryController::class, 'store'])->name('dictionary.store');
    Route::get('/dictionaries/{dictionary}/edit', [DictionaryController::class, 'edit'])->name('dictionary.edit');
    Route::put('/dictionaries/{dictionary}', [DictionaryController::class, 'update'])->name('dictionary.update');
    Route::delete('/dictionaries/{dictionary}', [DictionaryController::class, 'destroy'])->name('dictionary.destroy');
});
