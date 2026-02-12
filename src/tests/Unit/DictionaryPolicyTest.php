<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Policies\DictionaryPolicy;
use App\Models\User;
use App\Models\Dictionary;

class DictionaryPolicyTest extends TestCase
{
    public function test_update_is_allowed_for_owner_and_denied_for_others()
    {
        $policy = new DictionaryPolicy();

        $owner = new User();
        $owner->id = 1; // id は fillable ではないため個別代入にする
        $other = new User();
        $other->id = 2;

        $ownedDictionary = new Dictionary(['user_id' => 1]);

        $this->assertTrue($policy->update($owner, $ownedDictionary));
        $this->assertFalse($policy->update($other, $ownedDictionary));
    }

    public function test_delete_is_allowed_for_owner_and_denied_for_others()
    {
        $policy = new DictionaryPolicy();

        $owner = new User();
        $owner->id = 10;
        $other = new User();
        $other->id = 20;

        $ownedDictionary = new Dictionary(['user_id' => 10]);

        $this->assertTrue($policy->delete($owner, $ownedDictionary));
        $this->assertFalse($policy->delete($other, $ownedDictionary));
    }
}


