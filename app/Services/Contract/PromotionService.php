<?php

namespace App\Services\Contract;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;

interface PromotionService
{

    public function getAllActivePromotion(): Collection;

    public function handleUploadImage($file): string;

    public function createPromotion(array $promotion); 

    public function updatePromotion(array $data, Promotion $promotion);
}
