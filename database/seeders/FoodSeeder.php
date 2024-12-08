<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $foodNames = [
            'Nasi Goreng', 'Sate', 'Rendang', 'Gado-Gado', 'Bakso', 'Soto', 'Nasi Uduk', 'Nasi Padang', 'Ayam Goreng', 'Pecel Lele',
            'Mie Goreng', 'Mie Ayam', 'Nasi Kuning', 'Lontong', 'Ketoprak', 'Tahu Tek', 'Tahu Campur', 'Rawon', 'Gudeg', 'Pempek',
            'Martabak', 'Kerak Telor', 'Bubur Ayam', 'Nasi Liwet', 'Ayam Bakar', 'Ikan Bakar', 'Sop Buntut', 'Sop Kambing', 'Sop Iga', 'Sop Ayam',
            'Sate Kambing', 'Sate Ayam', 'Sate Padang', 'Sate Lilit', 'Sate Maranggi', 'Sate Madura', 'Sate Ponorogo', 'Sate Blora', 'Sate Klathak', 'Sate Taichan',
            'Gulai', 'Opor Ayam', 'Ayam Betutu', 'Ayam Taliwang', 'Ayam Rica-Rica', 'Ayam Pop', 'Ayam Penyet', 'Ayam Geprek', 'Ayam Kremes', 'Ayam Kalasan',
        ];

        $user = User::query()->first();

        $vendor = Vendor::query()->create([
            'user_id' => $user->id,
            'name' => 'Vendor 1',
            'image_url' => fake()->imageUrl(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
        ]);

        foreach ($categories as $category)
            for ($i = 0; $i < 10; $i++)
                $category->foods()->create([
                    'name' => $foodNames[array_rand($foodNames)],
                    'vendor_id' => $vendor->id,
                    'user_id' => $user->id,
                    'price' => fake()->randomNumber(5),
                    'image_udl' => fake()->imageUrl(240, 240),
                ]);
    }
}