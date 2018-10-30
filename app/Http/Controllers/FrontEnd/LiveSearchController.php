<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\SubCategory;
use App\Division;
use App\District;
use App\Upazila;
use App\AuctionImage;
use App\AuctionDetail;
use App\User;
use DB;

class LiveSearchController extends Controller
{
    public function action(Request $request) {
        
         $term = $request->term;
         $data = DB::table('auction_details')
					->where('auctionTitle','LIKE','%'.$term.'%')
					->orderBy('created_at', 'desc')
					->limit(10)
					->get();
         if(count($data) == 0)
         {
             $searchResult[] = 'No item Found'; 
         }
         else {
             foreach ($data as $key => $value) {
                 $searchResult[] = $value->auctionTitle;
             }
         }
         return response()->json($searchResult);
    }
}
