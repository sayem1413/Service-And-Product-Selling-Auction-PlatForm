<?php

namespace App\Http\Controllers\Admin;

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

class AuctionSearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function auctionTitleSearch(Request $request) {
        
        $searchKeyword = $request->searchAuctionTitle;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/auction-search/results/');
    }
    
    public function auctionTitleSearchResults() {
        $auctions = AuctionDetail::count();
        $searchKeyword = Session::get('searchKeyword');
        if(empty($searchKeyword)){
            $allAuctions = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }else{
            $allAuctions = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.auctionTitle', 'LIKE', '%'.$searchKeyword.'%')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }
        
        return view('admin.auctionsManage.auctionsManage', ['allAuctions' => $allAuctions, 'auctions' => $auctions]);
    }
    
    public function auctionEndDateSearch(Request $request) {
        $searchKeyword = $request->auctionExpiryDate;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/auction-enddate/results/');
    }
    
    public function auctionEndDateSearchResults() {
        $auctions = AuctionDetail::count();
        $searchKeyword = Session::get('searchKeyword');
        if(empty($searchKeyword)){
            $allAuctions = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }else{
            $allAuctions = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.auctionExpiryDate', $searchKeyword)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }
        
        return view('admin.auctionsManage.auctionsManage', ['allAuctions' => $allAuctions, 'auctions' => $auctions]);
    }
    
    public function auctionOnDateSearch(Request $request) {
        $searchKeyword = $request->auctionOnDate;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/auction-ondate/results/');
    }
    
    public function auctionOnDateSearchResults() {
        $auctions = AuctionDetail::count();
        $searchKeyword = Session::get('searchKeyword');
        if(empty($searchKeyword)){
            $allAuctions = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }else{
            $allAuctions = DB::table('all_auction_details_views')
                            ->whereDate('all_auction_details_views.created_at', $searchKeyword)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }
        
        return view('admin.auctionsManage.auctionsManage', ['allAuctions' => $allAuctions, 'auctions' => $auctions]);
    }
    
    public function auctionIdSearch(Request $request) {
        $searchKeyword = $request->auctionId;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/search/auction-id/');
    }
    
    public function auctionIdSearchResults() {
        $auctions = AuctionDetail::count();
        $searchKeyword = Session::get('searchKeyword');
        $hasAuctions = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.id', '=', $searchKeyword)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        if($hasAuctions){
            $allAuctions = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.id', '=', $searchKeyword)
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }else{
            $allAuctions = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }
        
        return view('admin.auctionsManage.auctionsManage', ['allAuctions' => $allAuctions, 'auctions' => $auctions]);
    }
    
    public function auctionPriceSearch(Request $request) {
        $minPrice = $request->minPrice;
        Session::put('minPrice', $minPrice);
        
        $maxPrice = $request->maxPrice;
        Session::put('maxPrice', $maxPrice);
        
        return redirect('/admin/price-range/results/');
    }
    
    public function auctionPriceSearchResults() {
        $auctions = AuctionDetail::count();
        $minPrice = Session::get('minPrice');
        $maxPrice = Session::get('maxPrice');
        
        if(empty($minPrice) && empty($maxPrice)){
            $allAuctions = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->orderBy('all_auction_details_views.created_at', 'DESC')
                            ->paginate(2);
        }elseif(empty($minPrice)){
            $allAuctions = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $maxPrice)
                            ->orderBy('all_auction_details_views.price', 'DESC')
                            ->paginate(2);
        }elseif(empty($maxPrice)){
            $allAuctions = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '>=', $minPrice)
                            ->orderBy('all_auction_details_views.price', 'DESC')
                            ->paginate(2);
        }
        else{
            $allAuctions = DB::table('all_auction_details_views')
                            ->where('all_auction_details_views.price', '<=', $maxPrice)
                            ->where('all_auction_details_views.price', '>=', $minPrice)
                            ->orderBy('all_auction_details_views.price', 'DESC')
                            ->paginate(2);
        }
        
        return view('admin.auctionsManage.auctionsManage', ['allAuctions' => $allAuctions, 'auctions' => $auctions]);
    }
    
}
