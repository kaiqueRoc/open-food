<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ProductModel;

class ProductTest extends TestCase
{

    public function testRootEndpoint()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Fullstack Challenge 20201026');
    }

    public function testGetProductByCode()
    {
        $product = ProductModel::query()->first();

        $response = $this->get('/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'barcode',
            'status',
            'imported_t',
            'url',
            'product_name',
            'quantity',
            'categories',
            'packaging',
            'brands',
            'image_url',
        ]);
        $responseData = $response->json();
        $this->assertNotEmpty($responseData['code']);
        $this->assertNotEmpty($responseData['barcode']);
        $this->assertNotEmpty($responseData['status']);
    }

    public function testListAllProducts()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $responseData = $response->json();
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'code',
                    'barcode',
                    'status',
                    'imported_t',
                    'url',
                    'product_name',
                    'quantity',
                    'categories',
                    'packaging',
                    'brands',
                    'image_url',
                    'created_at',
                    'updated_at',
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links' => [
                '*' => [
                    'url',
                    'label',
                    'active',
                ]
            ],
            'next_page_url',
            'path',
            'per_page' ,
            'prev_page_url',
            'to',
            'total',
        ]);
        $response->assertJson([
            'per_page' => 10,
        ]);
    }
}
