<?php

namespace Tests\Feature;

use Database\Seeders\CategorySeeder;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_get_categories()
    {
        $this->seed([
            CategorySeeder::class
        ]);

        $response = $this->get('/api/v1/categories');

        print_r($response->getContent());
        $response->assertStatus(200);

        $response2 = $this->get('/api/v1/categories?limit=2');
        $response2->assertStatus(200);
        $response2->assertJsonCount(2, 'data');

        $response3 = $this->get('/api/v1/categories?search=sayuran');

        $response3->assertStatus(200);
        $response3->assertSeeText('Sayuran');
    }

    public function test_categories_not_found()
    {
        $response = $this->get('/api/v1/categories');

        $response->assertStatus(404);
        $response->assertSeeText('Categories not found.');
    }


}
