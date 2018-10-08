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

class InternalFilterController extends Controller
{
    public function filterSearch(Request $request) {
        $amountMax = $request->amountMax;
        Session::put('amountMax', $amountMax);
        
        $amountMin = $request->amountMin;
        Session::put('amountMin', $amountMin);
        
        $date = $request->date;
        Session::put('date', $date);
        
        $subcategories = $request->subcategories;
        Session::put('subcategories', $subcategories);
        
        $districts = $request->districts;
        Session::put('districts', $districts);
        
        $upazilas = $request->upazilas;
        Session::put('upazilas', $upazilas);
        
        return redirect('/filter/searches');
    }
    
    public function filterSearchResults() {
         
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        
        $amountMax = Session::get('amountMax');
        $amountMin = Session::get('amountMin');
        $date = Session::get('date');
        $subcategory_id = Session::get('subcategories');
        $district_id = Session::get('districts');
        $upazila_id = Session::get('upazilas');
        
        if(empty($amountMax) && empty($amountMin) && empty($date) && $subcategory_id == 0 && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
             return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMin) && empty($date) && $subcategory_id == 0 && $district_id == 0 && $upazila_id == 0){
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.price', 'ASC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($date) && $subcategory_id == 0 && $district_id == 0 && $upazila_id == 0){
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.price', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($date) && $subcategory_id == 0 && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.price', 'ASC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && $subcategory_id == 0 && $district_id == 0 && $upazila_id == 0)
        {
            $searchResults = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && empty($date) && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && empty($date) && $subcategory_id == 0 && $upazila_id == 0){
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && empty($date) && $subcategory_id == 0){
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMax) && empty($amountMin) && empty($date)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMax) && empty($amountMin)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMax)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (!empty($amountMax) && !empty($amountMin) && !empty($date) && $subcategory_id != 0 && $district_id != 0 && $upazila_id != 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMin)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMin) && empty($date)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMin) && empty($date) && $subcategory_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMin) && empty($date) && $subcategory_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMax) && $subcategory_id == 0 && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMax)&& $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($amountMax)&& $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if (empty($date)) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if ($subcategory_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if ($district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        
        if($subcategory_id == 0 && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if($district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if($upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.price', '>=', $amountMin)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMin) && empty($date) && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMin) && empty($date) && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && $subcategory_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && $subcategory_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->where('all_auction_details_views.upazila_id', $upazila_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMin) && $district_id == 0 && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $amountMax)
                            ->whereDate('all_auction_details_views.created_at', $date)
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
            return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        if(empty($amountMax) && empty($amountMin) && empty($date) && $upazila_id == 0) {
            $searchResults = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.subcategory_id', $subcategory_id)
                            ->where('all_auction_details_views.district_id', $district_id)
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(5);
             return view('frontEnd.searchResult.categoryResult', ['searchResults' => $searchResults, 'divisions' => $divisions, 'districts' => $districts, 'upazilas' => $upazilas, 'categories' => $categories, 'subCategories' => $subCategories]);
        }
        
        
    }
    
}
