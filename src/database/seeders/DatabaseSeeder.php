<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dictionary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * 固定の3ユーザー（パスワードはすべて password）
     */
    private function getFixedUsers(): array
    {
        $password = Hash::make('password');
        return [
            ['name' => '山田 太郎', 'email' => 'yamada@example.com', 'password' => $password],
            ['name' => '佐藤 花子', 'email' => 'sato@example.com', 'password' => $password],
            ['name' => '鈴木 一郎', 'email' => 'suzuki@example.com', 'password' => $password],
        ];
    }

    /**
     * 英単語 → 日本語のペア（keyword 10文字以内 / description 50文字以内）
     */
    private function getWordPairs(): array
    {
        return [
            ['keyword' => 'apple',   'description' => 'リンゴ'],
            ['keyword' => 'book',    'description' => '本'],
            ['keyword' => 'water',   'description' => '水'],
            ['keyword' => 'sun',     'description' => '太陽'],
            ['keyword' => 'dog',     'description' => '犬'],
            ['keyword' => 'cat',     'description' => '猫'],
            ['keyword' => 'car',     'description' => '車'],
            ['keyword' => 'tree',    'description' => '木'],
            ['keyword' => 'star',    'description' => '星'],
            ['keyword' => 'house',   'description' => '家'],
            ['keyword' => 'school',  'description' => '学校'],
            ['keyword' => 'friend',  'description' => '友達'],
            ['keyword' => 'music',   'description' => '音楽'],
            ['keyword' => 'flower',  'description' => '花'],
            ['keyword' => 'cloud',   'description' => '雲'],
        ];
    }

    public function run()
    {
        $pairs = $this->getWordPairs();
        $index = 0;

        foreach ($this->getFixedUsers() as $attr) {
            $user = User::create($attr);
            for ($i = 0; $i < 5; $i++) {
                $pair = $pairs[$index];
                Dictionary::create([
                    'user_id'     => $user->id,
                    'keyword'     => $pair['keyword'],
                    'description' => $pair['description'],
                ]);
                $index++;
            }
        }
    }
}
