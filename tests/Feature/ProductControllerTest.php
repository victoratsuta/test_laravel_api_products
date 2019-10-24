<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseMigrations;

    public $productResponseStructure = [
        "id",
        "name",
        "description",
        "image",
        "category_id",
        "created_at",
        "updated_at"
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');

    }

    public function testGet()
    {
        $response = $this->get('/api/product');
        $response->assertJsonStructure([
            "current_page",
            "data" => [
                0 => $this->productResponseStructure
            ],
            "first_page_url",
            "from",
            "last_page",
            "last_page_url",
            "next_page_url",
            "path",
            "per_page",
            "prev_page_url",
            "to",
            "total",
        ]);
        $response->assertStatus(200);
    }

    public function testCreate()
    {

        Storage::fake('local');

        $categoryId = Category::inRandomOrder()->first()->id;

        $response = $this->json('POST', '/api/product', [
            "name" => "name",
            "description" => "name",
            "category_id" => $categoryId,
            'image' => UploadedFile::fake()->image('image.jpg')
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure($this->productResponseStructure);
        $image = $response->decodeResponseJson()["image"];

        Storage::disk('local')->assertExists("public/images/" . $image);
    }

    public function testShow()
    {
        $response = $this->get('/api/product/' . Product::inRandomOrder()->first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure($this->productResponseStructure);
    }

    public function testUpdate()
    {
        Storage::fake('local');

        $categoryId = Category::inRandomOrder()->first()->id;
        $productId = Product::inRandomOrder()->first()->id;

        $response = $this->json('PUT', '/api/product/' . $productId, [
            "name" => "name",
            "description" => "name",
            "category_id" => $categoryId,
            'image' => UploadedFile::fake()->image('image.jpg')
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure($this->productResponseStructure);
        $image = $response->decodeResponseJson()["image"];

        Storage::disk('local')->assertExists("public/images/" . $image);
    }

    public function testDelete()
    {
        $id = Product::inRandomOrder()->first()->id;
        $response = $this->delete('/api/product/' . $id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $id]);
    }
}
