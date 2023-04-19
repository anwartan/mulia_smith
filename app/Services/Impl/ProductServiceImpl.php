<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Services\Contract\ProductService;
use App\Utils\FileUpload;
use Illuminate\Database\Eloquent\Collection;

class ProductServiceImpl implements ProductService
{
    public function getAllProduct(): Collection {
        $products = Product::all();
        return $products;
    }

    public function getProductBySku(string $sku): Product {
        return Product::where('sku', $sku)->firstOrFail();
    }

    public function handleUploadImage($file): string {
        $filePath = "";
        if (!is_null($file)) {
            $filePath = FileUpload::upload($file);
        } 
        return $filePath;
    }
}
