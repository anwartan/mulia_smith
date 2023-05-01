<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PagingCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with(['productSale','category',]);
        $filters = $request->query();
        if(array_key_exists('search',$filters) && !is_null($filters['search'])) {
            $query->where('product_name','like','%'.$filters['search'].'%');
        }
        if(array_key_exists('category',$filters) && !is_null($filters['category'])) {
            $categories = explode(',', $filters['category']);

            $query->whereHas('category', function ($query1) use ($categories) {
                $query1->whereIn('category_code', $categories);
            });
        }
        
        if(array_key_exists('sort',$filters) && !is_null($filters['sort'])) {

            if($filters['sort'] == "Newest") 
            {
                $query->latest('created_at');
            } else if ($filters['sort'] == "Oldest")
            {
                $query->oldest("created_at");
            }
        }
    
        $product = $query->paginate(10);
        $pagination = new PagingCollection($product);
        return ResponseMapper::success($pagination);
    }

    public function detail(Product $product) 
    {
        $product->load(['productSale','category','productAdditionalInfos']);
        return ResponseMapper::success($product);
    }
}
