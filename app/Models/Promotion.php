<?php

namespace App\Models;

use App\Builder\RedisQueryBuilder;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends BaseModel
{
    use HasFactory;

    protected $redis = true;

    protected $fillable = [
        'promotion_title', 
        'promotion_description', 
        'promotion_url', 
        'promotion_image_url',
        'status',
        'uuid', 
    ];

    protected $hidden = [
        'id',
    ];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    protected $appends = ['full_image_path'];
    
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
            return true;
        });
    }

    public function getFullImagePathAttribute()
    {
        return url('files/promotion/'.$this->promotion_image_url);
    }
    
}
