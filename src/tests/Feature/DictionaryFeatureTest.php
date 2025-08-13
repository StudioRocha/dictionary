<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DictionaryFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_ok()
    {
        $this->get('/')
            ->assertOk();
    }

    public function test_create_page_ok()
    {
        // 認証が必要なため、テストユーザーでログインしてからアクセス
        /** @var \App\Models\User $user */
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user)
            ->get('/dictionaries/create')
            ->assertOk();
    }
}


