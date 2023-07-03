<?php

namespace Tests\Feature;

use App\Helpers\Products;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use App\Models\ProductModel;

class ImportProductsCommandTest extends TestCase
{


    public function testImportProducts()
    {
        $importedProductsCount = ProductModel::count();
        if ($importedProductsCount >= Products::TOTAL_PRODUCTS) {
            // Limpe a tabela de produtos
            ProductModel::truncate();
        }
        // Importa produtos
        $this->importProducts();

        // Verifica se a chave 'last_import_page' existe no cache
        $this->assertCacheHasKey('last_import_page');

        // Verifica o número total de produtos importados
        $this->assertTotalProductsImported(Products::TOTAL_PRODUCTS);

    }

    protected function importProducts()
    {
        // Executa o comando import:products
        $exitCode = Artisan::call('import:products');

        // Verifica se o código de saída é 0 (sem erros)
        $this->assertEquals(0, $exitCode);
    }

    protected function assertCacheHasKey($key)
    {
        // Verifica se a chave existe no cache
        $this->assertArrayHasKey($key, Cache::getStore()->get('default'));
    }

    protected function assertTotalProductsImported($expectedCount)
    {
        // Obtém o número total de produtos importados
        $importedProductsCount = ProductModel::count();

        // Verifica o número total de produtos importados
        $this->assertEquals($expectedCount, $importedProductsCount);
    }

}
