<?php

namespace App\Services;

use App\Helpers\Products;
use App\Models\ProductModel;

class ProductsService
{

    public static function saveProducts($products, $importedProducts)
    {
        foreach ($products as $productData) {
            if ($importedProducts >= Products::TOTAL_PRODUCTS) {
                return $importedProducts;
            }
            // Verifica se o produto já existe na base de dados
            $product = ProductModel::where('code', $productData['code'])->first();
            if ($product) {
                continue;
            }
            // Define os valores dos campos
            $product = new ProductModel();
            $product->create($productData);
            $importedProducts++; // Incrementa o contador de produtos importados
        }

        return $importedProducts;
    }
}
