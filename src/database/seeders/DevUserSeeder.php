<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DevUserSeeder extends Seeder
{
    public function run(): void
    {
        // ローカル環境のみ作成（本番では実行されない）
        if (app()->environment('local')) {
            User::updateOrCreate(
                ['email' => 'dev@example.com'], // 検索条件
                [
                    'name' => 'Dev User',
                    'password' => Hash::make('Dev-Local_2025!'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
