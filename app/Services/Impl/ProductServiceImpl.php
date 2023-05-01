<?php

namespace App\Services\Impl;

use App\Exceptions\BusinessException;
use App\Models\Product;
use App\Models\ProductAdditionalInfo;
use App\Services\Contract\ProductService;
use App\Utils\FileUpload;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public function createProduct(array $product) {
        try {
            DB::beginTransaction();     
            $newProduct = Product::create($product);
            if(isset($product['product_additional_info'])){
                $newProduct->productAdditionalInfos()->createMany($product['product_additional_info']);
            }
            $newProduct->productSale()->create($product['product_sale']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw new BusinessException("failed create product", $e);
        }
    }

    public function updateProduct(array $data, Product $product) {
        try {
            $product->update($data);
            $product->productSale()->updateOrCreate($data['product_sale']);
            $productAdditionalInfo = $data['product_additional_info'] ?? [];

            $productAdditionalInfoIds = collect($productAdditionalInfo)->pluck('id')->filter();
            $product->productAdditionalInfos()->whereNotIn('id', $productAdditionalInfoIds)->delete();

            foreach ($productAdditionalInfo as $productAdditionalInfoItem) {
                $productAdditional = $product->productAdditionalInfos()->updateOrCreate(
                    ['id' => $productAdditionalInfoItem['id']],
                    $productAdditionalInfoItem
                );
            }
            $product->fresh();
        } catch (Exception $e) {
            dd($e);
            throw new BusinessException("failed update product", $e);
        }
        
    }
}
