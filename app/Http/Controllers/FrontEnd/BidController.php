<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserAddress;
use App\UserInfo;
use App\CardInfo;
use App\Bid;
use DB;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('check_card');
    }
    
    public function createBid(Request $request, $id) {
        
//        $auctionDetails = DB::table('all_auction_details_views')
//                            ->select('all_auction_details_views.*')
//                            ->where('all_auction_details_views.id', $id)
//                            ->first();
        
//        $this->validate($request, [
//            'price' => 'required|integer|min:'.$auctionDetails->price
//        ]);
        
        $user_id = Auth::user()->id;
        $fee = (int) ($request->price * 0.01);
        $bid = new Bid();
        $bid->auction_id = $id;
        $bid->user_id = $user_id;
        $bid->fee = $request->price;
        $bid->paid = $fee;
        $bid->save();
        
        return redirect('/profile')->with('message', 'Sir, Your Bid has been completed!');
        
    }
    
    public function manageBids($id) {
//        $test = 'Auction Bids Checked!';
//        return $test;
        
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();
        $bids = DB::table('all_auction_details_views')
                ->join('bids', 'all_auction_details_views.id', '=', 'bids.auction_id')
                ->select('bids.*', 'all_auction_details_views.auctionTitle','all_auction_details_views.auctionDescription', 'all_auction_details_views.price')
                ->where('bids.user_id', '=', $id)
                ->orderBy('bids.id', 'ASC')
                ->paginate(5);

        return view('frontEnd.userBidManage.userBidManage', ['cardInfo' => $cardInfo, 'userAddress' => $userAddress, 'userInfo' => $userInfo, 'bids' => $bids]);
        
    }
    
    public function editBid($id) {
        
        $user_id = Auth::user()->id;
        
        $cardInfo = CardInfo::where('user_id',$user_id)->first();
        $userAddress = UserAddress::where('user_id',$user_id)->first();
        $userInfo = UserInfo::where('user_id',$user_id)->first();
        $bid = Bid::where('id',$id)->first();
        $auctionPrice = DB::table('all_auction_details_views')
                ->join('bids', 'all_auction_details_views.id', '=', 'bids.auction_id')
                ->select('all_auction_details_views.price')
                ->where('bids.user_id', '=', $user_id)
                ->where('bids.id', '=', $id)
                ->first();
        
        
        return view('frontEnd.userBidManage.userBidEdit', ['cardInfo' => $cardInfo, 'userAddress' => $userAddress, 'userInfo' => $userInfo, 'bid' => $bid, 'auctionPrice' => $auctionPrice]);
    }
    
    public function updateBid(Request $request) {
        
        $fee = (int) ($request->price * 0.01);
        $bid = Bid::where('id',$request->id)->first();
        $bid->fee = $request->price;
        $bid->paid = $fee;
        $bid->save();
        
        return redirect('/profile')->with('message', 'Sir, Your Bid has been updated!');
        
    }
    
    public function deleteBid($id) {
        
        $bid = Bid::where('id',$id)->first();
        $bid->delete();
        
        return redirect('/profile')->with('message', 'Sir, Your Bid has been deleted!');
        
    }
    
}
