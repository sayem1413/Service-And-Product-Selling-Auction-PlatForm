<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Division;
use App\User;
use App\UserAddress;
use App\UserInfo;
use DB;
use Intervention\Image\Facades\Image;

class UserProfileManageController extends Controller
{
    public function createUserProfile($id) {
        
        $divisions = Division::all();
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();
        return view('frontEnd.profile.createProfile', ['divisions' => $divisions, 'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }
    
    public function saveUserProfile(Request $request) {
        $this->validate($request, [
            'facebookLink' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i',
            'phoneNumber' => 'nullable|regex:/(01)[0-9]{9}/',
        ]);
        
        $userAddress = new UserAddress();
        $userAddress->division_id = $request->divisions;
        $userAddress->district_id = $request->districts;
        $userAddress->upazila_id = $request->upazilas;
        $userAddress->gpsLocation = $request->gpsLocation;
        $userAddress->dealingAddress = $request->dealingAddress;
        $userAddress->user_id = $request->user_id;
        $userAddress->save();
        
        if ($request->hasFile('profileImage')) {
            $profileImage = $request->file('profileImage');
            $imageName = time().'.'. $profileImage->getClientOriginalName();
            $uploadPath = 'public/images/profileImage/';
            Image::make($profileImage)->resize(150,150);
            $profileImage->move($uploadPath, $imageName);
            $imageUrl = $uploadPath . $imageName;
            $this->saveProfileInfoWithImage($request, $imageUrl);
        }
        else
        {
            $this->saveProfileInfoWithOutImage($request);
        }
        
        return redirect('/profile')->with('message', 'Profile info save successfully!');
    }
    
    public function saveProfileInfoWithImage($request, $imageUrl) {
        
        $userInfo = new UserInfo();
        $userInfo->profileImage = $imageUrl;
        $userInfo->phoneNumber = $request->phoneNumber;
        $userInfo->facebookLink = $request->facebookLink;
        $userInfo->dateOfBirth = $request->dateOfBirth;
        $userInfo->userCategory = $request->userCategory;
        $userInfo->gender = $request->gender;
        $userInfo->user_id = $request->user_id;
        $userInfo->save();
    }
    
    public function saveProfileInfoWithOutImage($request) {
        
        $userInfo = new UserInfo();
        $userInfo->phoneNumber = $request->phoneNumber;
        $userInfo->facebookLink = $request->facebookLink;
        $userInfo->dateOfBirth = $request->dateOfBirth;
        $userInfo->userCategory = $request->userCategory;
        $userInfo->gender = $request->gender;
        $userInfo->user_id = $request->user_id;
        $userInfo->save();
    }
    
    public function editUserProfile($id) {
        
        $divisions = Division::all();
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id', $id)->first();
        $userAddresses = DB::table('user_addresses')
                            ->join('districts', 'districts.id', '=', 'user_addresses.district_id')
                            ->join('upazilas', 'upazilas.id', '=', 'user_addresses.upazila_id')
                            ->select('districts.districtName','upazilas.upazilaName')
                            ->where('user_addresses.user_id', $id)
                            ->first();
        
        return view('frontEnd.profile.editProfile', ['divisions' => $divisions, 'userAddress' => $userAddress, 'userInfo' => $userInfo, 'userAddresses' => $userAddresses]);
    }
    
    public function updateUserProfile(Request $request) {
         $this->validate($request, [
            'facebookLink' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i',
            'phoneNumber' => 'nullable|regex:/(01)[0-9]{9}/',
        ]);
        
        $userAddress = UserAddress::where('user_id', $request->user_id)->first();
        if($request->has('divisions')){
            $userAddress->division_id = $request->divisions;
        }
        if($request->has('districts')){
            $userAddress->district_id = $request->districts;
        }
        if($request->has('upazilas')){
            $userAddress->upazila_id = $request->upazilas;
        }
        $userAddress->gpsLocation = $request->gpsLocation;
        $userAddress->dealingAddress = $request->dealingAddress;
        $userAddress->user_id = $request->user_id;
        $userAddress->save();
        
        
        if ($request->hasFile('profileImage')) {
            
            $imageUrl = $this->imageExistStatus($request);
            $this->updateUserInfoWithImage($request, $imageUrl);
        }
        else
        {
            $this->updateUserInfoWithOutImage($request);
        }

        return redirect('/profile')->with('message', 'Profile info updated successfully!');
    }
    
    public function imageExistStatus($request) {
        $userInfoById = UserInfo::where('user_id', $request->user_id)->first();
        $profileImage = $request->file('profileImage');
        $oldImage = $userInfoById->profileImage;
        if ($profileImage) {
            if($oldImage){
                unlink($oldImage);
            }
            $imageName = time().'.'. $profileImage->getClientOriginalName();
            $uploadPath = 'public/images/profileImage/';
            Image::make($profileImage)->resize(90,90);
            $profileImage->move($uploadPath, $imageName);
            $imageUrl = $uploadPath . $imageName;
        } else {
            $imageUrl = $userInfoById->profileImage;
        }
        return $imageUrl;
    }

    public function updateUserInfoWithImage($request, $imageUrl) {
        $userInfo = UserInfo::where('user_id', $request->user_id)->first();
        $userInfo->profileImage = $imageUrl;
        $userInfo->phoneNumber = $request->phoneNumber;
        $userInfo->facebookLink = $request->facebookLink;
        $userInfo->dateOfBirth = $request->dateOfBirth;
        $userInfo->userCategory = $request->userCategory;
        $userInfo->gender = $request->gender;
        $userInfo->save();
    }
    
    public function updateUserInfoWithOutImage($request) {
        $userInfo = UserInfo::where('user_id', $request->user_id)->first();
        $userInfo->phoneNumber = $request->phoneNumber;
        $userInfo->facebookLink = $request->facebookLink;
        $userInfo->dateOfBirth = $request->dateOfBirth;
        $userInfo->userCategory = $request->userCategory;
        $userInfo->gender = $request->gender;
        $userInfo->save();
    }
}
