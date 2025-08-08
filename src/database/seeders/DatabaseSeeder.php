<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // 他のSeeder呼び出しがあればここに追加

        // 開発用ユーザーSeederを呼び出す
        $this->call(DevUserSeeder::class);
    }
}
