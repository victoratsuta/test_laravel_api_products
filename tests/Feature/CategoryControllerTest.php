<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public $responseStructure = [
        "id",
        "name",
        "parent_id",
        "created_at",
        "updated_at",
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');

    }

    public function testGet()
    {
        $response = $this->get('/api/category');
        $response->assertJsonStructure([
            0 => $this->responseStructure
        ]);
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->json('POST', '/api/category', [
            "name" => "name",
            "description" => "name",
            "parent_id" => 1,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure($this->responseStructure);
    }

    public function testShow()
    {
        $response = $this->get('/api/category/' . Category::inRandomOrder()->first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure($this->responseStructure);
    }

    public function testUpdate()
    {
        $categoryExistingId = Category::inRandomOrder()->first()->id;

        $response = $this->json('PUT', '/api/category/' . $categoryExistingId, [
            "name" => "name",
            "parent_id" => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure($this->responseStructure);

    }

    public function testDelete()
    {
        $id = Category::inRandomOrder()->first()->id;
        $response = $this->delete('/api/category/' . $id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $id]);
    }
}
