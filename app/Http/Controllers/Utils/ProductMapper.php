<?php

namespace App\Http\Controllers\Utils;

use App\Http\Requests\product\CreateProductRequest;
use App\Http\Requests\product\EditProductRequest;
use App\Models\Product;

class ProductMapper
{
    public static function mapCreateProductRequestToModel(CreateProductRequest $createProductRequest): Product {
        $product = new Product();
        $product->product_name = $createProductRequest->product_name;
        $product->product_description = $createProductRequest->product_description;
        $product->sku = $createProductRequest->sku;
        $product->image_path = $createProductRequest->image_path;
        $product->link_url_shopee = $createProductRequest->link_url_shopee;
        $product->link_url_tokopedia = $createProductRequest->link_url_tokopedia;
        $product->status = $createProductRequest->status;
        return $product;
    }

    public static function mapEditProductRequestToModel(EditProductRequest $editProductRequest): Product {
        $product = new Product();
        $product->product_name = $editProductRequest->product_name;
        $product->product_description = $editProductRequest->product_description;
        $product->sku = $editProductRequest->sku;
        $product->image_path = $editProductRequest->image_path;
        $product->link_url_shopee = $editProductRequest->link_url_shopee;
        $product->link_url_tokopedia = $editProductRequest->link_url_tokopedia;
        $product->status = $editProductRequest->status;
        return $product;
    }
}
