<?php

use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DictionaryController::class, 'index'])->name('dictionary.index');
Route::get('/register', [DictionaryController::class, 'create'])->name('dictionary.create');
Route::post('/register', [DictionaryController::class, 'store'])->name('dictionary.store');
