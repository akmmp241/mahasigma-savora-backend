<?php

namespace Tests\Feature;

use Database\Seeders\CategorySeeder;
use Database\Seeders\FoodSeeder;
use Database\Seeders\UserSeeder;
use Tests\TestCase;

class FoodTest extends TestCase
{
    public function test_get_foods()
    {
        $this->seed([
            UserSeeder::class,
            CategorySeeder::class,
            FoodSeeder::class
        ]);

        $response = $this->get('/api/v1/foods');

        print_r($response->getContent());
        $response->assertStatus(200);

        $response2 = $this->get('/api/v1/foods?limit=2');
        $response2->assertStatus(200);
        $response2->assertJsonCount(2, 'data.data');

        $response3 = $this->get('/api/v1/foods?search=sate');

        $response3->assertStatus(200);
        $response3->assertSeeText('Sate');
    }

    public function test_foods_not_found()
    {
        $response = $this->get('/api/v1/foods');

        $response->assertStatus(404);
        $response->assertSeeText('Foods not found.');
    }


}
