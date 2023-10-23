<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'author'=>User::all()->random()->id,
            'category_id'=> Category::all()->random()->id,
            'title'=>$title,
            'slug'=>Str::slug($title,'-'),
            // 'thumbnail'=>fake()->image(public_path('images'),640,480,'nature'),
            'thumbnail'=>fake()->imageUrl(640,480),
            'content'=>fake()->sentence(30),
            'created_at'=>fake()->dateTimeBetween('-4 years','now'),
            'updated_at'=>now(),
        ];
    }
}
