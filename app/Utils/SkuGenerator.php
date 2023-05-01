<?php

namespace App\Utils;

use App\Models\Category;
use App\Models\Product;

class SkuGenerator
{

    public static function generateProductSku(Product $product): string
    {
        $desiredLength = 4;
        $category = Category::find($product->category_id);
        $count = count(Product::where('category_id',$product->category_id)->get())+1;
        $countString = str_pad($count, $desiredLength, '0', STR_PAD_LEFT);
        $sku = $category->category_code . "-" . $countString ;
        return $sku;
    }
}
