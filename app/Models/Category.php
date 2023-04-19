<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name', 
        'uuid', 
        'status'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function isActive()
    {
        return $this->status == StatusEnum::ACTIVE;
    }

    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
            return true;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
