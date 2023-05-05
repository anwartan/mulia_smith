<?php

namespace App\Models;

use App\Casts\DatetimeToTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'visitor_id', 
        'user_id',
    ];

    protected $hidden = [
        'id','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(WishlistItem::class);
    }
    protected $apiCasts = [
        'created_at' => DatetimeToTimestamp::class,
        'updated_at' => DatetimeToTimestamp::class,
    ];
}
