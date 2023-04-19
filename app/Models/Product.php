<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 
        'product_description', 
        'sku', 
        'image_path',
        'link_url_shopee',
        'link_url_tokopedia',
        'status'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'status' => ProductStatusEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $size = count(Product::all())+1;
            $model->sku = 'SKU'.$size;
            return true;
        });
    }
}
