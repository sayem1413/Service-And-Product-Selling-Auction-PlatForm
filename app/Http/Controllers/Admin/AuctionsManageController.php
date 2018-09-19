<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\SubCategory;
use App\Division;
use App\District;
use App\Upazila;
use App\AuctionDetail;
use App\AuctionCategory;
use App\AuctionPlace;
use App\AuctionImage;
use App\SellerDetail;
use DB;
use Intervention\Image\Facades\Image;

class AuctionsManageController extends Controller
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

    public function manageAuctions() {
        
        $allAuctions = DB::table('all_auction_details_views')
                ->select('all_auction_details_views.*')
                ->paginate(2);

        return view('admin.auctionsManage.auctionsManage', ['allAuctions' => $allAuctions]);
        
    }
    
    public function showAuctionDetails($id) {
        
        $auctionViewById = DB::table('all_auction_details_views')
                ->select('all_auction_details_views.*')
                ->where('all_auction_details_views.id', $id)
                ->first();

        return view('admin.auctionsManage.singleAuctionView', ['auctionViewById' => $auctionViewById]);
        
    }
    
    public function deleteAuction($id) {
        $auction_detail = AuctionDetail::find($id);
        $auction_category = AuctionCategory::where('auction_id', $id)->first();
        $auction_places = AuctionPlace::where('auction_id', $id)->first();
        $auctionImage = AuctionImage::where('auction_id', $id)->first();
        $sellerDetail = SellerDetail::where('auction_id', $id)->first();

        $adImage1 = $auctionImage->adImage1;
        $adImage2 = $auctionImage->adImage2;
        $adImage3 = $auctionImage->adImage3;
        if ($adImage1 == $adImage2 && $adImage2 == $adImage3) {
            unlink($adImage1);
        } elseif ($adImage1 == $adImage2) {
            unlink($adImage1);
            unlink($adImage3);
        } elseif ($adImage1 == $adImage3) {
            unlink($adImage1);
            unlink($adImage2);
        } elseif ($adImage2 == $adImage3) {
            unlink($adImage1);
            unlink($adImage2);
        } else {
            if ($adImage1) {
                unlink($adImage1);
            }
            if ($adImage2) {
                unlink($adImage2);
            }
            if ($adImage3) {
                unlink($adImage3);
            }
        }

        $auction_detail->delete();
        $auction_category->delete();
        $auction_places->delete();
        $auctionImage->delete();
        $sellerDetail->delete();
        

        return redirect('/admin/auctions/manage')->with('message', 'Auction info deleted successfully!');
    }
    
    
}
