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
use App\UserAddress;
use App\UserInfo;
use App\CardInfo;
use DB;

class BidWinnerController extends Controller
{
    public function bidWinnerForUserAuction($id) {
        $userId = Auth::user()->id;
        $cardInfo = CardInfo::where('user_id',$userId)->first();
        $userAddress = UserAddress::where('user_id',$userId)->first();
        $userInfo = UserInfo::where('user_id',$userId)->first();
        
        $currentTime = Carbon::now()->format('Y-m-d');
        $auctionEndTime = AuctionTime::where('auction_id', $id)->first();
        $auctionEndDateTime = $auctionEndTime->auctionExpiryDate;
        if($currentTime >= $auctionEndDateTime){
            $isUserHasBid = Bid::where('auction_id', $id)->limit(1)->max('fee');
            //print_r($isUserHasBid->auction_id);
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
            $isHasBid = Bid::where('auction_id', $id)->limit(1)->max('fee');
            if($isHasBid){
                $winnerPriceChange = Bid::where('auction_id', $id)->limit(1)->max('fee');
                $bidWinnerChange = Bid::where('fee', $winnerPriceChange)->where('auction_id', $id)->first();
                if($bidWinnerChange->won == 1){
                    $bidWinnerChange->won = 0;
                    $bidWinnerChange->save();
                }
            }
            $isUserHasBid = NULL;
            $bidWinner = NULL;
            $winnerInfo = NULL;
        }
        return view('frontEnd.bidWinner.bidWinnerForUserAuction',['isUserHasBid' => $isUserHasBid, 'currentTime' => $currentTime,'auctionEndDateTime' => $auctionEndDateTime, 'bidWinner' => $bidWinner, 'winnerInfo' => $winnerInfo, 'cardInfo' => $cardInfo, 'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }
}
