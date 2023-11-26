<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_index(): void
    {
        $response = $this->get('/api/products');

        $response->assertOk();
    }

    public function test_products_show(): void
    {
        $response = $this->get('/api/products/1');

        $response->assertOk();
    }

    public function test_products_store(): void
    {
        $response = $this->post('/api/products', [
            'title' => 'Product Title',
            'description' => 'Product Description',
            'price' => '333',
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Product Title',
            'description' => 'Product Description',
            'price' => '333',
        ]);

        $response->assertOk();
    }

    public function test_products_update(): void
    {
        $response = $this->put('/api/products/1', [
            'title' => 'Product Title UPD',
            'description' => 'Product Description UPD',
            'price' => '4444',
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Product Title UPD',
            'description' => 'Product Description UPD',
            'price' => '4444',
        ]);

        $response->assertOk();
    }

    public function test_products_delete(): void
    {
        $response = $this->delete('/api/products/1');

        $response->assertStatus(204);
    }
}
