<?php

namespace App\Http\Controllers\API;

use App\Enums\StatusEnum;
use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function filter(Request $request)
    {
        $categories = Category::where('status',StatusEnum::ACTIVE)->withCount('product')->get();
        return ResponseMapper::success($categories);
    }
}
