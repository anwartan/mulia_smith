<?php

namespace App\Services\Contract;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Summary of ProductService
 */
interface ProductService
{

    public function getAllProduct(): Collection;

    public function getProductBySku(string $sku): Product;

    public function handleUploadImage($file): string;

    public function createProduct(array $product);

    public function updateProduct(array $data, Product $product);
}
