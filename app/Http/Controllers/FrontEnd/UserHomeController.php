<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserAddress;
use App\UserInfo;
use App\CardInfo;
use DB;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $cardInfo = CardInfo::where('user_id',$id)->first();
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
        
        return view('frontEnd.profile.profile', ['cardInfo' => $cardInfo,'userAddress' => $userAddress, 'userInfo' => $userInfo, 'userDivision' => $userDivision, 'userDistrict' => $userDistrict, 'userUpazila' => $userUpazila]);
    }
}
