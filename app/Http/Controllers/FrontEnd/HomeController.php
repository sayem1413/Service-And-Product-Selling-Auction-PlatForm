<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Division;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $sliderMobiles = DB::table('all_auction_details_views')
                ->where('all_auction_details_views.subcategory_id', '=', 1)
                ->orderBy('all_auction_details_views.created_at', 'DESC')
                ->limit(4)
                ->get();
        $sliderLaptops = DB::table('all_auction_details_views')
                ->where('all_auction_details_views.subcategory_id', '=', 4)
                ->orderBy('all_auction_details_views.created_at', 'DESC')
                ->limit(4)
                ->get();
        $sliderBikes = DB::table('all_auction_details_views')
                ->where('all_auction_details_views.subcategory_id', '=', 6)
                ->orderBy('all_auction_details_views.created_at', 'DESC')
                ->limit(4)
                ->get();
        $sliderCars = DB::table('all_auction_details_views')
                ->where('all_auction_details_views.subcategory_id', '=', 7)
                ->orderBy('all_auction_details_views.created_at', 'DESC')
                ->limit(4)
                ->get();
        
        return view('frontEnd.home.homeContent', ['categories' => $categories, 'sliderMobiles' => $sliderMobiles, 'sliderLaptops' => $sliderLaptops, 'sliderBikes' => $sliderBikes, 'sliderCars' => $sliderCars]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
