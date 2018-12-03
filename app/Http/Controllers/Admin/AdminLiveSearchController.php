<?php

namespace App\Http\Controllers\Admin;

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

class AdminLiveSearchController extends Controller
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
    
    public function searchEmail(Request $request) {
        
         $term = $request->term;
         $data = DB::table('users')
                        ->where('email','LIKE','%'.$term.'%')
                        ->limit(10)
                        ->get();
         if(count($data) == 0)
         {
             $searchResult[] = 'No email Found'; 
         }
         else {
             foreach ($data as $key => $value) {
                 $searchResult[] = $value->email;
             }
         }
         return response()->json($searchResult);
    }
    
    public function searchName(Request $request) {
        
         $term = $request->term;
         $data = DB::table('users')
                        ->where('name','LIKE','%'.$term.'%')
                        ->limit(10)
                        ->get();
         if(count($data) == 0)
         {
             $searchResult[] = 'No users Found'; 
         }
         else {
             foreach ($data as $key => $value) {
                 $searchResult[] = $value->name;
             }
         }
         return response()->json($searchResult);
    }
}
