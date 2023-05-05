<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\promotion\CreatePromotionRequest;
use App\Http\Requests\promotion\EditPromotionRequest;
use App\Models\Promotion;
use App\Services\Contract\PromotionService;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    private PromotionService $promotionService;

    public function __construct(PromotionService $promotionService) {
        $this->promotionService = $promotionService;
    }
    
    public function index()
    {
        return view('page.promotion.promotion',['promotions'=> Promotion::all()]);
    }

  
    public function create()
    {
        return view('page.promotion.add-promotion',['status'=>StatusEnum::cases()]);
    }


    public function store(CreatePromotionRequest $request)
    {
        $promotion = $request->validated();
        $image = $this->promotionService->handleUploadImage($request->file('promotion_image'));
        $promotion['promotion_image_url'] = $image;
        $new = Promotion::create($promotion);
        return redirect('/promotion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit(Promotion $promotion)
    {
        return view('page.promotion.edit-promotion',['status'=>StatusEnum::cases(),'promotion' => $promotion]);
    }

    public function update(EditPromotionRequest $request, Promotion $promotion)
    {
        $data = $request->validated();

        $image = $this->promotionService->handleUploadImage($request->file('promotion_image'));
        if(!empty($image)){
            $data['promotion_image_url'] = $image;
        }
        $this->promotionService->updatePromotion($data, $promotion);
        return redirect('/promotion');
    }

  
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect('/promotion');
    }
}
