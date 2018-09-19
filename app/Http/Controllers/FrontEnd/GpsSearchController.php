<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Category;
use App\SubCategory;
use App\Division;
use App\District;
use App\Upazila;
use App\AuctionCategory;
use App\AuctionDetail;
use App\AuctionPlace;
use App\AuctionImage;
use App\SellerDetail;
use DB;

class GpsSearchController extends Controller
{
    public function gpsSearch(Request $request) {
        $this->validate($request, [
            'output' => 'required',
        ]);
        $output = $request->output;
        Session::put('output', $output);
        
        return redirect('/geo-search/results');
    }
    
    public function gpsSearchResults() {
        $output = Session::get('output');
        
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        
        $categoryName = Session::get('categoryName');
        $searchKeyword = Session::get('searchKeyword');
        $division_id = Session::get('division_id');
        $category_id = Session::get('category_id');
        
        
        
        $searchResults = DB::table('all_auction_details_views')
                        ->where('all_auction_details_views.gpsLocation', 'LIKE', '%'.$output.'%')
                        ->orderBy('all_auction_details_views.created_at', 'DESC')
                        ->paginate(5);
            
        return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
    }
    
}
