<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Console\Commands\ImportProductsCommand;
use App\Models\ProductModel;
use Carbon\Carbon;

class ImportProductsCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testImportProducts()
    {
        // Simula a execução do comando
        $this->artisan('import:products')
            ->expectsOutput('Imported X products from page Y')
            ->assertExitCode(0);

        // Verifica se os produtos foram importados corretamente
        $importedProducts = ProductModel::whereDate('imported_t', Carbon::now()->format('Y-m-d'))->count();
        $this->assertEquals(100, $importedProducts);
    }
}
