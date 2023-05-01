<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'label', 
        'value', 
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
