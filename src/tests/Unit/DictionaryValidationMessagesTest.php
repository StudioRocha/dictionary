<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DictionaryStoreRequest;

class DictionaryValidationMessagesTest extends TestCase
{
    public function test_messages_are_returned_for_each_field()
    {
        $rules = (new DictionaryStoreRequest())->rules();
        $messages = (new DictionaryStoreRequest())->messages();

        $validator = Validator::make(['keyword' => '', 'description' => ''], $rules, $messages);
        $this->assertTrue($validator->fails());

        $errors = $validator->errors()->toArray();
        $this->assertArrayHasKey('keyword', $errors);
        $this->assertArrayHasKey('description', $errors);
    }

    public function test_boundary_lengths_are_validated()
    {
        $rules = (new DictionaryStoreRequest())->rules();

        // OK: 9/49
        $ok1 = Validator::make(['keyword' => str_repeat('a', 9), 'description' => str_repeat('b', 49)], $rules);
        $this->assertFalse($ok1->fails());

        // OK: 10/50
        $ok2 = Validator::make(['keyword' => str_repeat('a', 10), 'description' => str_repeat('b', 50)], $rules);
        $this->assertFalse($ok2->fails());

        // NG: 11/51
        $ng = Validator::make(['keyword' => str_repeat('a', 11), 'description' => str_repeat('b', 51)], $rules);
        $this->assertTrue($ng->fails());
    }
}


