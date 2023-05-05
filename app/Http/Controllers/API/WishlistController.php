<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class WishlistController extends Controller
{
    public function addProduct(Request $request, Product $product)
    {
        $userId = auth()->id();
        $productId = $product->id;
        $visitorId = $request->cookie('visitor_id');
        $existingWishlist = Wishlist::where('visitor_id', $visitorId)->first();
        $id = is_null($existingWishlist) ? null : $existingWishlist->id;
        $wishlist = Wishlist::updateOrCreate(
            ['id'=> $id],
            [
                'visitor_id'=>$visitorId,
                'user_id'=>$userId
            ]
        );
       
        
        $wishlistItem = WishlistItem::where('product_id',$productId)->whereHas('wishlist',function($query) use($visitorId ) {
            $query->where('visitor_id',$visitorId );
        })->first();

        if($wishlistItem){
            $wishlistItem->delete();
            return ResponseMapper::success("Successfull delete product wishlist");

        } else {
            $wishlist->items()->create([
                'product_id'=>$productId
            ]);
            return ResponseMapper::success("Successfull add product wishlist");
        }
    }

    public function getWishlist(Request $request)
    {
        
        $visitorId = $request->cookie('visitor_id');

        $userId = auth()->id();
        $query =  Wishlist::query()->with(['items.product']);
        
        if(!is_null($visitorId)){
            $data = $query->firstWhere('visitor_id', $visitorId);
            return ResponseMapper::success($data);
        }
        if(!isNull($userId)){
            $data = $query->firstWhere('user_id', $userId);
            return ResponseMapper::success($data);
        }
        return ResponseMapper::success();
    }

    
}
