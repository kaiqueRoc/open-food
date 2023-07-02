<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;

class ProductController
{
    public function show($code)
    {

        $product = ProductModel::where('id', $code)->first();

        if ($product) {
            return response()->json($product, 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function index()
    {
        $products = ProductModel::paginate(10);

        return response()->json($products, 200, [], JSON_PRETTY_PRINT);
    }

}
