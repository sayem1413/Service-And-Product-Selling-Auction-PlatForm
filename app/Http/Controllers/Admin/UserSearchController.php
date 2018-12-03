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

class UserSearchController extends Controller
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
    
    public function userEmailSearch(Request $request) {
        
        $searchKeyword = $request->searchUserEmail;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/email-search/results/');
    }
    
    public function userEmailSearchResults() {
        
        $searchKeyword = Session::get('searchKeyword');
        if(empty($searchKeyword)){
            $users = DB::table('users')
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
        }else{
            $users = DB::table('users')
                    ->where('users.email', 'LIKE', '%'.$searchKeyword.'%')
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
        }
        
        return view('admin.userManage.manageUsers', ['users' => $users]);
    }
    
    public function userNameSearch(Request $request) {
        
        $searchKeyword = $request->searchUserName;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/name-search/results/');
    }
    
    public function userNameSearchResults() {
        
        $searchKeyword = Session::get('searchKeyword');
        if(empty($searchKeyword)){
            $users = DB::table('users')
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
        }else{
            $users = DB::table('users')
                    ->where('users.name', 'LIKE', '%'.$searchKeyword.'%')
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
        }
        
        return view('admin.userManage.manageUsers', ['users' => $users]);
    }
    
    public function userIdSearch(Request $request) {
        $searchKeyword = $request->userId;
        Session::put('searchKeyword', $searchKeyword);
        
        return redirect('/admin/search/user-id/');
    }
    
    public function userIdSearchResults() {
        $searchKeyword = Session::get('searchKeyword');
        $hasUsers = DB::table('users')
                    ->where('users.id', '=', $searchKeyword)
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
         
        if($hasUsers){
            $users = DB::table('users')
                    ->where('users.id', '=', $searchKeyword)
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
        }else{
            $users = DB::table('users')
                    ->select('users.id', 'users.name', 'users.email')
                    ->paginate(10);
        }
        
        return view('admin.userManage.manageUsers', ['users' => $users]);
    }
    
}
