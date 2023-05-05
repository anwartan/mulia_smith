<?php

namespace App\Services\Impl;

use App\Enums\StatusEnum;
use App\Models\Promotion;
use App\Services\Contract\PromotionService;
use App\Utils\FileUpload;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redis;

class PromotionServiceImpl implements PromotionService
{

    public function getAllActivePromotion(): Collection {
        return Promotion::where('status',StatusEnum::ACTIVE)->remember()->get();
    }

    public function handleUploadImage($file): string {
        $filePath = "";
        if (!is_null($file)) {
            $filePath = FileUpload::upload($file,"/promotion/");
        } 
        return $filePath;
    }
    public function createPromotion(array $promotion) {
        $newPromotion = Promotion::create($promotion);
    }

    public function updatePromotion(array $data, Promotion $promotion) {
        $updatedData = $promotion->update($data);
    }
}
