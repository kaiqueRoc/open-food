<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class ProductController
{
    public function show($code)
    {

          try {
              $product = ProductModel::where('id', $code)->first();
              return response()->json($product, 200, [], JSON_PRETTY_PRINT);

          } catch (QueryException $e) {
              return Response::json([
                  'success' => false,
                  'message' => 'Produto Nao econtrado',
              ], 400);
          } catch (\Exception $e) {
              return Response::json([
                  'success' => false,
                  'message' => $e->getMessage(),
              ], 404);
          }
    }

    public function index()
    {

        try {
            $products = ProductModel::paginate(10);
            return response()->json($products, 200, [], JSON_PRETTY_PRINT);

        } catch (QueryException $e) {
            return Response::json([
                'success' => false,
                'message' => 'Erro ao realizar consulta, tente novamente mais tarde.',
            ], 400);
        } catch (\Exception $e) {
            return Response::json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

}
