<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use App\Utils\SkuGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 
        'product_summary',
        'product_description', 
        'sku', 
        'image_path',
        'link_url_shopee',
        'link_url_tokopedia',
        'status',
        'category_id',
        
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'status' => ProductStatusEnum::class,
    ];

    protected $appends = ['full_image_path'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->sku = SkuGenerator::generateProductSku($model);
            return true;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'sku';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productSale()
    {
        return $this->hasOne(ProductSale::class);
    }

    public function productAdditionalInfos()
    {
        return $this->hasMany(ProductAdditionalInfo::class);
    }

    public function getFullImagePathAttribute()
    {
        return url('files/'.$this->image_path);
    }
}
