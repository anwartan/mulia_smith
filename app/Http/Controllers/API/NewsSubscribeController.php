<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\newssubscribe\AddNewsSubscribeRequest;
use App\Models\NewsSubscribe;
use Illuminate\Http\Request;

class NewsSubscribeController extends Controller
{
    
    public function addSubscriber(AddNewsSubscribeRequest $request)
    {
        $data = $request->validated();
        NewsSubscribe::create($data);
        return ResponseMapper::success("Email successfully subscribed");
    }
}
