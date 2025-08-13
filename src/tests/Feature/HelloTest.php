<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HelloTest extends TestCase
{
    // このテストは、ユーザーを1件ファクトリで作成し、DBに保存されたことを確認するシンプルな永続化テストです。
    // 画面やルートを経由せず、モデル層のみを対象にしています。
    public function testHello()
    {
        // 準備: ユーザーを作成（簡略のためパスワードは平文のまま）
        // アプリ側で自動ハッシュ（例: casts の 'password' => 'hashed'）が有効だとこの後の比較は一致しません。
           User::factory()->create([
             'name'=>'aaa',
             'email'=>'bbb@ccc.com',
            'password'=>'test12345'
         ]);
        // 検証: 指定レコードが users テーブルに存在すること
         $this->assertDatabaseHas('users',[
            'name'=>'aaa',
             'email'=>'bbb@ccc.com',
             'password'=>'test12345'
         ]);
    }
}

