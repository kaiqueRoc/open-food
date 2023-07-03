<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    protected $fillable = [
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
        'image_url'
    ];

    protected $casts = [
        'imported_t' => 'datetime'
    ];

    public function create($productData)
    {

        $this->code = $productData['code'];
        $this->barcode = $productData['code'] . ' (EAN / EAN-13)';
        $this->status = 'imported';
        $this->imported_t = Carbon::now();
        $this->url = $productData['url'];
        $this->product_name = isset($productData['product_name']) ? $productData['product_name'] : $productData['product_name_en'];
        $this->quantity = $productData['quantity'];
        $this->categories = $productData['categories'];
        $this->packaging = $productData['packaging'];
        $this->brands = $productData['brands'];
        $this->image_url = isset($productData['image_url']) ? $productData['image_url'] : null;
        $this->save();
    }

}
