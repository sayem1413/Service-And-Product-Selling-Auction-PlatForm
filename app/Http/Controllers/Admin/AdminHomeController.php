<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\SubCategory;
use App\Comment;
use App\AuctionDetail;
use App\AuctionCategory;
use App\AuctionPlace;
use App\AuctionImage;
use App\SellerDetail;
use DB;

class AdminHomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $category = Category::count();
        $auctions = AuctionDetail::count();
        
        return view('admin.home.homeContent', ['users' => $users, 'category' => $category, 'auctions' => $auctions]);
    }
}
