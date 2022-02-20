<?php

namespace Database\Factories;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model=Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::random(20),
            'description'=>$this->faker->paragraph(),
            'user_id' =>  \App\Models\User::factory(),
            'created_at'=>now()
        ];
    }
}
