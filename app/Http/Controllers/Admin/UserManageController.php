<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\SellerDetail;
use App\AuctionDetail;
use App\AuctionCategory;
use App\AuctionPlace;
use App\AuctionImage;
use App\UserAddress;
use App\UserInfo;
use DB;

class UserManageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function manageUsers() {
        $users = DB::table('users')
                ->select('users.id', 'users.name', 'users.email')
                ->paginate(10);
        
        return view('admin.userManage.manageUsers', ['users' => $users]);
    }
    
    public function userDetails($id) {
        
        $user = User::where('id',$id)->first();
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();
        $userDivision = DB::table('user_addresses')
                            ->join('divisions', 'divisions.id', '=', 'user_addresses.division_id')
                            ->select('divisions.divisionName')
                            ->where('user_addresses.user_id', $id)
                            ->first();
        
        $userDistrict = DB::table('user_addresses')
                            ->join('districts', 'districts.id', '=', 'user_addresses.district_id')
                            ->select('districts.districtName')
                            ->where('user_addresses.user_id', $id)
                            ->first();
        
        $userUpazila = DB::table('user_addresses')
                            ->join('upazilas', 'upazilas.id', '=', 'user_addresses.upazila_id')
                            ->select('upazilas.upazilaName')
                            ->where('user_addresses.user_id', $id)
                            ->first();
        
        return view('admin.userManage.showUserDetails', ['user' => $user,'userAddress' => $userAddress, 'userInfo' => $userInfo, 'userDivision' => $userDivision, 'userDistrict' => $userDistrict, 'userUpazila' => $userUpazila]);
    }
    
    public function userAuctions($id) {
        $userAuctions = DB::table('all_auction_details_views')
                ->select('all_auction_details_views.*')
                ->where('all_auction_details_views.user_id', $id)
                ->paginate(2);
        
        $user = User::where('id',$id)->first();
        
        return view('admin.userManage.viewUserAuctions', ['user' => $user, 'userAuctions' => $userAuctions]);
    }
    
    public function userAuctionShow($id) {
        $userAuctionById = DB::table('all_auction_details_views')
                ->select('all_auction_details_views.*')
                ->where('all_auction_details_views.id', $id)
                ->first();
        
        return view('admin.userManage.viewUserAuction', ['userAuctionById' => $userAuctionById]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $auctionDetail = AuctionDetail::where('user_id', $id)->delete();
        $auctionCategory = AuctionCategory::where('user_id', $id)->delete();
        $auctionImages = AuctionImage::where('user_id', $id)->get();
        $userAddress = UserAddress::where('user_id', $id)->delete();
        $userInfo = UserInfo::where('user_id', $id)->first();
        
        foreach ($auctionImages as $auctionImage)
        {
            $adImage1 = $auctionImage->adImage1;
            $adImage2 = $auctionImage->adImage2;
            $adImage3 = $auctionImage->adImage3;
            if(file_exists($adImage1) || file_exists($adImage2) || file_exists($adImage3))
            {
                if($adImage1 == $adImage2 && $adImage2 == $adImage3){
                     unlink($adImage1);
                     break;
                }
                if($adImage1 == $adImage2)
                {
                    unlink($adImage1);
                    unlink($adImage3);
                     break;
                }
                if($adImage1 == $adImage3)
                {
                    unlink($adImage1);
                    unlink($adImage2);
                     break;
                }
                if($adImage2 == $adImage3)
                {
                    unlink($adImage1);
                    unlink($adImage2);
                     break;
                }
                if($adImage1){
                     unlink($adImage1);
                }
                if($adImage2){
                     unlink($adImage2);
                }
                if($adImage3){
                     unlink($adImage3);
                }
            }
        }
        
        $userProfile = $userInfo->userProfile;
        
        if(file_exists($userProfile))
        {
            if($userProfile){
                 unlink($userProfile);
            }
        }
        
        $auctionImagesDelete = AuctionImage::where('user_id', $id)->delete();
        $auctionPlace = AuctionPlace::where('user_id', $id)->delete();
        $sellerDetail = SellerDetail::where('user_id', $id)->delete();
        $userInfo->delete();
        $user->delete();
        
        return redirect('/admin/manage-users')->with('message', 'User info deleted successfully!');
    }
    
    public function deleteUserAuction($id) {
        $auction_detail = AuctionDetail::find($id);
        $auction_category = AuctionCategory::where('auction_id', $id)->first();
        $auction_places = AuctionPlace::where('auction_id', $id)->first();
        $auctionImage = AuctionImage::where('auction_id', $id)->first();
        $sellerDetail = SellerDetail::where('auction_id', $id)->first();
        $user_id = SellerDetail::where('auction_id', $id)->select('user_id')->first();

        $adImage1 = $auctionImage->adImage1;
        $adImage2 = $auctionImage->adImage2;
        $adImage3 = $auctionImage->adImage3;
        
        if(file_exists($adImage1) || file_exists($adImage2) || file_exists($adImage3))
        {
            
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
        }
        

        $auction_detail->delete();
        $auction_category->delete();
        $auction_places->delete();
        $auctionImage->delete();
        $sellerDetail->delete();
        

        return redirect('/admin/manage-users')->with('message', 'User info deleted successfully!');
    }
    
}
