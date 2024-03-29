<?php

namespace App\Console\Commands;

use App\Http\Controllers\OpenFoodController;
use App\Services\EmailService;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertEmail;
use App\Services\ProductsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Console\Command;
use App\Models\ProductModel;
use Carbon\Carbon;
use App\Helpers\Products;


class ImportProductsCommand extends Command
{
    protected $signature = 'import:products';
    protected $description = 'Import products from Open Food Facts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $totalProducts = new EmailService();
        $startDate = Carbon::today()->startOfDay();
        $endDate = Carbon::today()->endOfDay();
        $importedProducts = ProductModel::whereBetween('imported_t', [$startDate, $endDate])->count();


        if ($importedProducts === 0){
            Cache::delete('last_import_page');
        } elseif ($importedProducts >= Products::TOTAL_PRODUCTS) {
            return $totalProducts->alertImportProducts($importedProducts);
        }

        $productsPerMinute = Products::PRODUCTS_PER_MINUTES; // Quantidade inicial de produtos por minuto
        $currentPage = Cache::get('last_import_page') ?: 1; // Página atual

        // Se não houver valor armazenado no cache, significa que é o primeiro dia de importação
        while ($importedProducts < Products::TOTAL_PRODUCTS) {
            try {
                $openFood = new OpenFoodController();
                $response = $openFood->getProducts($productsPerMinute, $currentPage);
                // Verifica se a requisição foi bem-sucedida
                if (!isset($response['products'])) {
                 $totalProducts->alertErroNotFoundProducts($response);
                }
                // Percorre os produtos obtidos
                $importedProducts = ProductsService::saveProducts($response['products'], $importedProducts);
                $totalProducts->alertTotalImportProducts($importedProducts,$currentPage );
                $currentPage++;
                Cache::put('last_import_page', $currentPage, 1440);

            } catch (\Exception $e) {
                $totalProducts->alertErroImportProducts($currentPage,  $e->getMessage());
                sleep(60); // Atraso de 60 segundos

            }
        }
    }
}
