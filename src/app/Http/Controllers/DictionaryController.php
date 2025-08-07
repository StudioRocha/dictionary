<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function index()
    {
        return view('dictionary.search'); // トップ（検索画面）
    }

    public function create()
    {
        return view('dictionary.register'); // 登録画面
    }
}
