<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DateTime;

use App\User;
use App\AuctionCategory;
use App\AuctionDetail;
use App\AuctionImage;
use App\AuctionPlace;
use App\AuctionTime;
use App\Comment;
use App\Bid;
use DB;

class AuctionDetailsViewController extends Controller
{
    public function index($id) {

        
        $currentTime = Carbon::now()->format('Y-m-d');
        
        $auctionEndTime = AuctionTime::where('auction_id', $id)->first();
        $auctionEndDateTime = $auctionEndTime->auctionExpiryDate;
        if(Auth::check()){
            $user_id = Auth::user()->id;
            if($currentTime >= $auctionEndDateTime){ //End Time (User Authenticated)
                $isUserHasBid = Bid::where('auction_id', $id)->first();
                if($isUserHasBid){
                    $winnerPrice = Bid::where('auction_id', $id)->limit(1)->max('fee');
                    $bidWinner = Bid::where('fee', $winnerPrice)->where('auction_id', $id)->first();
                    if($bidWinner->won == 0){
                        $bidWinner->won = 1;
                        $bidWinner->save();
                    }
                    $winnerId = $bidWinner->user_id;
                    $winnerInfo = User::where('id', $winnerId)->first();
                } 
                if(!$isUserHasBid) {
                    $isUserHasBid = NULL;
                    $bidWinner = NULL;
                    $winnerInfo = NULL;
                }
            }
            if($currentTime < $auctionEndDateTime){ //Remaining Time (User Authenticated)
                $isHasBid = Bid::where('auction_id', $id)->limit(1)->max('fee'); //For Change start here
                if($isHasBid){
                    $winnerPriceChange = Bid::where('auction_id', $id)->limit(1)->max('fee');
                    $bidWinnerChange = Bid::where('fee', $winnerPriceChange)->where('auction_id', $id)->first();
                    if($bidWinnerChange->won == 1){
                        $bidWinnerChange->won = 0;
                        $bidWinnerChange->save();
                    }
                } // For Change end here
                $isUserHasBid = Bid::where('auction_id', $id)->first();
                if($isUserHasBid){
                    $isUserHasBid = Bid::where('user_id', $user_id)->where('auction_id', $id)->first();
                    $bidWinner = NULL;
                    $winnerInfo = NULL;
                }
                if(!$isUserHasBid) {
                    $isUserHasBid = NULL;
                    $bidWinner = NULL;
                    $winnerInfo = NULL;
                }
            }
            
        }
        if(!Auth::check()){
            if($currentTime >= $auctionEndDateTime){
                $isUserHasBid = Bid::where('auction_id', $id)->limit(1)->max('fee');
                if($isUserHasBid){
                    $winnerPrice = Bid::where('auction_id', $id)->limit(1)->max('fee');
                    $bidWinner = Bid::where('fee', $winnerPrice)->where('auction_id', $id)->first();
                    if($bidWinner->won == 0){
                        $bidWinner->won = 1;
                        $bidWinner->save();
                    }
                    $winnerId = $bidWinner->user_id;
                    $winnerInfo = User::where('id', $winnerId)->first();
                }
                if(!$isUserHasBid){
                    $isUserHasBid = NULL;
                    $bidWinner = NULL;
                    $winnerInfo = NULL;
                }
            }
            if($currentTime < $auctionEndDateTime){
                $isHasBid = Bid::where('auction_id', $id)->limit(1)->max('fee'); //For Change start here
                if($isHasBid){
                    $winnerPriceChange = Bid::where('auction_id', $id)->limit(1)->max('fee');
                    $bidWinnerChange = Bid::where('fee', $winnerPriceChange)->where('auction_id', $id)->first();
                    if($bidWinnerChange->won == 1){
                        $bidWinnerChange->won = 0;
                        $bidWinnerChange->save();
                    }
                } // For Change end here
                $isUserHasBid = NULL;
                $bidWinner = NULL;
                $winnerInfo = NULL;
            }
        }
        
        $comments = Comment::where('auction_id', $id)->get();
        
        $auctionDetails = DB::table('all_auction_details_views')
                            ->select('all_auction_details_views.*')
                            ->where('all_auction_details_views.id', $id)
                            ->first();
        return view('frontEnd.auctionDetailsView.auctionDetailsView',['auctionDetails' => $auctionDetails, 'comments' => $comments, 'isUserHasBid' => $isUserHasBid, 'currentTime' => $currentTime,'auctionEndDateTime' => $auctionEndDateTime, 'bidWinner' => $bidWinner, 'winnerInfo' => $winnerInfo]);
    }
}
