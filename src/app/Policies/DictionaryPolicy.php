<?php

namespace App\Policies;

use App\Models\Dictionary;
use App\Models\User;

class DictionaryPolicy
{
    public function update(User $user, Dictionary $dictionary): bool
    {
        return $user->id === $dictionary->user_id;
    }

    public function delete(User $user, Dictionary $dictionary): bool
    {
        return $user->id === $dictionary->user_id;
    }
}


