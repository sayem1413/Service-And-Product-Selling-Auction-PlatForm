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

class InternalSearchController extends Controller
{
    public function index(Request $request) {
        
        $categoryName = Category::find($request->categories);
        Session::put('categoryName', $categoryName);
        
        $searchKeyword = $request->search;
        Session::put('searchKeyword', $searchKeyword);
        
        $division_id = $request->divisions;
        Session::put('division_id', $division_id);
        
        $category_id = $request->categories;
        Session::put('category_id', $category_id);
        
        return redirect('/search/result');
    }
    
    public function searchResultShow() {
        
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        
        $categoryName = Session::get('categoryName');
        $searchKeyword = Session::get('searchKeyword');
        $division_id = Session::get('division_id');
        $category_id = Session::get('category_id');
        
        
        if($division_id == 0 && $category_id == 0){
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.auctionTitle', 'LIKE', '%'.$searchKeyword.'%')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }elseif($division_id == 0 && empty($searchKeyword)){
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.category_id', $category_id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }elseif($category_id == 0 && empty($searchKeyword)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.division_id', $division_id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }elseif($division_id == 0)
        {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.auctionTitle', 'LIKE', '%'.$searchKeyword.'%')
                            ->where('all_auction_details_views.category_id', $category_id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }elseif($category_id == 0)
        {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.auctionTitle', 'LIKE', '%'.$searchKeyword.'%')
                            ->where('all_auction_details_views.category_id', $division_id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }elseif (empty($searchKeyword)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.division_id', $division_id)
                            ->where('all_auction_details_views.category_id', $category_id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }else{
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.auctionTitle', 'LIKE', '%'.$searchKeyword.'%')
                            ->where('all_auction_details_views.division_id', $division_id)
                            ->where('all_auction_details_views.category_id', $category_id)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }
        
        
        return view('frontEnd.searchResult.categoryResult', ['categoryName' => $categoryName, 'searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
    }
    
    public function headerSearch(Request $request) {
        $searchKeyword = $request->searchHeader;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/search/results');
    }
    public function headerSearchResults() {
        
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        
        $searchKeyword = Session::get('searchKeyword');
        if(empty($searchKeyword)){
            $searchResults = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }else{
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.auctionTitle', 'LIKE', '%'.$searchKeyword.'%')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
        }
        
        return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
    }
}
