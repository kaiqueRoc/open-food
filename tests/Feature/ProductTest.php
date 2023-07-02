<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProductModel;

class ProductTest extends TestCase
{


    public function testRootEndpoint()
    {
        $response = $this->get('/');
        $response->assertResponseStatus(200);
        $this->assertStringContainsString('Fullstack Challenge 20201026', $response->getC());
    }

    public function testGetProductByCode()
    {
        $product = ProductModel::factory()->create();

        $response = $this->get('/products/' . $product->code);

        $response->assertResponseStatus(200);
        $response->assertJson([
            'code' => $product->code,
            'barcode' => $product->barcode,
            'status' => $product->status,
            'imported_t' => $product->imported_t,
            'url' => $product->url,
            'product_name' => $product->product_name,
            'quantity' => $product->quantity,
            'categories' => $product->categories,
            'packaging' => $product->packaging,
            'brands' => $product->brands,
            'image_url' => $product->image_url,
        ]);
    }

    public function testListAllProducts()
    {
        $products = ProductModel::factory()->count(10)->create();

        $response = $this->get('/products');

        $response->assertResponseStatus(200);
        $response->assertJsonCount(10);
        $response->assertJsonStructure([
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
            ]
        ]);
    }
}

