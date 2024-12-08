<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create();

        User::factory()->create([
            'email' => 'test@test.com',
        ]);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}
