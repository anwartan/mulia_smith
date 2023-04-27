<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 
        'weight', 
        'cost', 
    ];

    protected $hidden = [
        'id',
        'product_id'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
