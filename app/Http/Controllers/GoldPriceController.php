<?php

namespace App\Http\Controllers;

use App\Models\GoldPrice;
use Illuminate\Http\Request;

class GoldPriceController extends Controller
{
   
    public function index()
    {
        $new = GoldPrice::latest('created_at')->first();
        return view('page.price.price',['prices'=> GoldPrice::all(), 'current_price'=> $new ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoldPrice  $goldPrice
     * @return \Illuminate\Http\Response
     */
    public function show(GoldPrice $goldPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoldPrice  $goldPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(GoldPrice $goldPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoldPrice  $goldPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoldPrice $goldPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoldPrice  $goldPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoldPrice $goldPrice)
    {
        //
    }
}
