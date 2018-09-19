<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\UserAddress;
use App\UserInfo;
use DB;

class ProfileViewController extends Controller
{
    public function index($id) {
        $user = User::where('id', $id)->first();
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
        
        return view('frontEnd.profile.profileView', ['user' => $user, 'userAddress' => $userAddress, 'userInfo' => $userInfo, 'userDivision' => $userDivision, 'userDistrict' => $userDistrict, 'userUpazila' => $userUpazila]);
    }
}
