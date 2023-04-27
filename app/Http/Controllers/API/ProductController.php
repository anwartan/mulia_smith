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
        $query = Product::query()->with(['productSale','category']);
        $filters = $request->query();
        if(array_key_exists('search',$filters) && !is_null($filters['search'])) {
            $query->where('product_name','like','%'.$filters['search'].'%');
        }
        
        // if(!is_null($filters['state_id'])) {
        //     $queryUser->whereHas('profile',function($q) use ($filters){
        //         return $q->where('state_id','=',$filters['state_id']);
        //     });
        // }
        
        // if(!is_null($filters['city_id'])) {
        //     $queryUser->whereHas('profile',function($q) use ($filters){
        //         return $q->where('city_id','=',$filters['city_id']);
        //     });
        // }
        
        $product = $query->paginate(10);
        $pagination = new PagingCollection($product);
        return ResponseMapper::success($pagination);
    }

    public function detail(Product $product) 
    {
        return ResponseMapper::success($product);
    }
}
