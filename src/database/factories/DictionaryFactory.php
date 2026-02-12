<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DictionaryFactory extends Factory
{
    public function definition()
    {
        $keyword = Str::limit($this->faker->word(), 10, '') ?: $this->faker->lexify('???????');
        $description = Str::limit($this->faker->sentence(), 50, '');

        return [
            'user_id' => User::factory(),
            'keyword' => $keyword,
            'description' => $description,
        ];
    }
}
