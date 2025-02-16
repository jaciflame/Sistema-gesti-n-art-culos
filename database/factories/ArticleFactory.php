<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=>fake()->unique()->sentence(2,true),
            "content"=>fake()->text(),
            "user_id"=>User::all()->random()->id,
            "tag_id"=>Tag::all()->random()->id
        ];
    }
}
