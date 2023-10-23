<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::insert([
        //     [
        //         'name' => "Is Admin",
        //         'slug'=>'is-admin',
        //         'email' => 'admin@exm.com',
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'role'=>'admin',
        //         'phone'=>'089652289021'
        //     ],
        //     [
        //         'name' => "Is Author",
        //         'slug'=>'is-author',
        //         'email' => 'author@exm.com',
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'role'=>'author',
        //         'phone'=>'089652281221'
        //     ],
        //     [
        //         'name' => "Is User",
        //         'slug'=>'is-user',
        //         'email' => 'user@exm.com',
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'role'=>'user',
        //         'phone'=>'089652536221'
        //     ]
        // ]);
        // Category::insert([
        //     ['name' => 'Travel', 'created_at'=>now()],
        //     ['name' => 'Lifestyle','created_at'=>now()],
        //     ['name' => 'Computer','created_at'=>now()],
        //     ['name' => 'News','created_at'=>now()],
        //     ['name' => 'Tips&Trick','created_at'=>now()],
        // ]);
        Blog::factory()->count(90)->create();
        // User::factory()->count(2)->has(
        //     Blog::factory()->count(2)->state(
        //         function (array $attribute, User $user) {
        //             return [
        //                 'author' => $user->id,
        //             ];
        //         }
        //     )
        // )->create();

        
    }
}
