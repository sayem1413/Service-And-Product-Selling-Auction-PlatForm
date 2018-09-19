<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Category;
use App\SubCategory;
use App\Division;
use App\District;
use App\Upazila;
use App\AuctionImage;
use App\AuctionDetail;
use App\User;
use DB;

class CategoryWiseAdController extends Controller {

    public function categoryWiseAlladd($id) {
        
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        
        $categoryName = Category::find($id);
        
        $searchResults = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->where('all_auction_details_views.category_id', $id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        
        
        return view('frontEnd.searchResult.categoryResult', ['categoryName' => $categoryName, 'searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
    }
    
    public function areaWiseAlladd() {
        $division_id = Input::get('division_id');
        $searchResults = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->where('all_auction_details_views.division_id', $division_id)
                            ->paginate(10);
        
        
        return response()->json($searchResults);
    }
    

}
