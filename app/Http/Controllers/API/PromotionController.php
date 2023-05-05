<?php

namespace App\Http\Controllers\API;

use App\Enums\StatusEnum;
use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Services\Contract\PromotionService;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    private PromotionService $promotionService;

    public function __construct(PromotionService $promotionService) {
        $this->promotionService = $promotionService;
    }

    public function index(Request $request)
    {
        $promotion = $this->promotionService->getAllActivePromotion();
        return ResponseMapper::success($promotion);
    }
}
