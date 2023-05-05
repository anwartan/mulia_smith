<?php

namespace App\Models;

use App\Casts\DatetimeToTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'wishlist_id', 
        'product_id',
    ];

    protected $hidden = [
        'id','product_id', 'wishlist_id'
    ];

    protected $apiCasts = [
        'created_at' => DatetimeToTimestamp::class,
        'updated_at' => DatetimeToTimestamp::class,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function wishlist() {
        return $this->belongsTo(Wishlist::class);
    }
}
