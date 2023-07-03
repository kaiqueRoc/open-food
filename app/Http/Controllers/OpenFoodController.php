<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use function response;

class OpenFoodController
{

    public function getProducts($productsPerMinute, $page)
    {
        try {
            $totalProducts = new EmailService();
            $url = 'https://world.openfoodfacts.org/cgi/search.pl?search_terms=&search_simple=1&action=process&json=1&page_size=' . $productsPerMinute . '&page=' . $page;
            $client = new Client();
            $response = $client->get($url);
            $jsonData = $response->getBody()->getContents();
            $dataArray = json_decode($jsonData, true);

            if ($response->getStatusCode() != 200) {
                 $totalProducts->alertErroImportProducts($page);
                return response()->json([
                    'error' => true,
                    'message' => 'Failed to import products from page ' . $page,
                ]);
            }

            return $dataArray;
        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
