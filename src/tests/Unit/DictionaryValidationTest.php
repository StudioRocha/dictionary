<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DictionaryStoreRequest;
use App\Http\Requests\DictionaryUpdateRequest;

class DictionaryValidationTest extends TestCase
{
    public function test_store_rules_accept_max_lengths()
    {
        $rules = (new DictionaryStoreRequest())->rules();

        $okData = [
            'keyword' => str_repeat('a', 10),  // 10文字ちょうど
            'description' => str_repeat('b', 50), // 50文字ちょうど
        ];

        $this->assertFalse(Validator::make($okData, $rules)->fails());
    }

    public function test_store_rules_reject_over_max_lengths()
    {
        $rules = (new DictionaryStoreRequest())->rules();

        $ngData = [
            'keyword' => str_repeat('a', 11),  // 10文字超過
            'description' => str_repeat('b', 51), // 50文字超過
        ];

        $this->assertTrue(Validator::make($ngData, $rules)->fails());
    }

    public function test_store_rules_require_fields()
    {
        $rules = (new DictionaryStoreRequest())->rules();

        $ngData = [
            'keyword' => '',
            'description' => '',
        ];

        $validator = Validator::make($ngData, $rules);
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('keyword', $validator->errors()->toArray());
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
    }

    public function test_update_rules_mirror_store_rules()
    {
        $storeRules = (new DictionaryStoreRequest())->rules();
        $updateRules = (new DictionaryUpdateRequest())->rules();

        $this->assertSame($storeRules, $updateRules, 'Update ルールは Store ルールと同一であるべき');
    }
}


