<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldPrice extends BaseModel
{
    use HasFactory;

    protected $redis = false;

    protected $fillable = [
        'goldPriceIDR','goldPriceIDRGram','goldPriceUSD'
    ];

    protected $hidden = [
        'id',
    ];
}
