<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;

use App\Category;
use App\SubCategory;
use App\Manufacturer;
use App\SubcategoryManufacturer;
use App\Division;
use App\District;
use App\Upazila;
use App\Color;
use App\User;
use App\AuctionDetail;
use App\AuctionCategory;
use App\AuctionPlace;
use App\AuctionImage;
use App\AuctionTime;
use App\SellerDetail;
use DB;
use Intervention\Image\Facades\Image;

class PostAdController extends Controller {

    public function categoryAreaSave(Request $request) {
        $this->validate($request, [
            'categories' => 'required|not_in:""',
            'subcategories' => 'required|not_in:""',
            'divisions' => 'required|not_in:""',
            'districts' => 'required|not_in:""',
            'upazilas' => 'required|not_in:""',
        ]);
        $gpsLocation = $request->gpsLocation;
        Session::put('gpsLocation', $gpsLocation);
        $categoryId = $request->categories;
        Session::put('categoryId', $categoryId);
        $category = Category::where('id', $categoryId)->first();
        Session::put('category', $category);
        $subcategoryId = $request->subcategories;
        Session::put('subcategoryId', $subcategoryId);
        $subcategory = SubCategory::where('id', $subcategoryId)->first();
        Session::put('subcategory', $subcategory);
        $divisionId = $request->divisions;
        $division = Division::where('id', $divisionId)->first();
        Session::put('division', $division);
        $districtId = $request->districts;
        $district = District::where('id', $districtId)->first();
        Session::put( 'district', $district);
        $upazilaId = $request->upazilas;
        $upazila = Upazila::where('id', $upazilaId)->first();
        Session::put('upazila', $upazila);

        return redirect('/post-ad/details');
    }
    
    public function postAdDetails() {
        $gpsLocation = Session::get('gpsLocation');
        $categoryId = Session::get('categoryId');
        $category = Session::get('category');
        $subcategoryId = Session::get('subcategoryId');
        $subcategory = Session::get('subcategory');
        $division = Session::get('division');
        $district = Session::get('district');
        $upazila = Session::get('upazila');
        
//        if($categoryId == 1 || $categoryId == 2 || $categoryId == 3 || $categoryId == 5 || $categoryId == 6){
//            $manfacturers = DB::table('subcategory_manufacturers')
//                                    ->join('manufacturers', 'subcategory_manufacturers.manufacturer_id', '=', 'manufacturers.id')
//                                    ->select('manufacturers.id','manufacturers.manufacturerName')
//                                    ->where('subcategory_manufacturers.subcategory_id', '=', $subcategoryId)
//                                    ->paginate(10);
//        }
//        else{
//            $manfacturers = 0;
//        }
        
        return view('frontEnd.postAd.saveAd', ['gpsLocation' => $gpsLocation, 'category' => $category, 'subcategory' => $subcategory, 'division' => $division, 'district' => $district, 'upazila' => $upazila]);
    }
    
    public function postAdSave(Request $request) {
        $this->validate($request, [
            'auctionTitle' => 'required',
            'auctionDescription' => 'required',
            'condition' => 'required|in:0,1',
            'price' => 'required',
            'phoneNumber' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        
        $auctionDetail = new AuctionDetail();
        $auctionDetail->auctionTitle = $request->auctionTitle;
        $auctionDetail->auctionDescription = $request->auctionDescription;
        $auctionDetail->condition = $request->condition;
        $auctionDetail->price = $request->price;
        if($request->negotiable == 1)
        {
            $auctionDetail->negotiable = $request->negotiable;
        }
        $auctionDetail->user_id = $request->user_id;
        $auctionDetail->save();
        $auction_id = $auctionDetail->id;
        Session::put('auction_id', $auction_id);
        
        $auctionTime = new AuctionTime();
        if($request->forAuction == 1 && !empty($request->auctionExpiryDate)){
            $auctionTime->auctionExpiryDate = $request->auctionExpiryDate;
            $auctionTime->auction_id =  Session::get('auction_id');
            $auctionTime->save();
        }else{
            $auctionTime->auction_id =  Session::get('auction_id');
            $auctionTime->save();
        }
        
        $auctionCategory = new AuctionCategory();
        $auctionCategory->category_id = $request->category_id;
        $auctionCategory->subcategory_id = $request->subcategory_id;
        $auctionCategory->user_id = $request->user_id;
        $auctionCategory->auction_id = Session::get('auction_id');
        $auctionCategory->save();
        
        $auctionPlace = new AuctionPlace();
        $auctionPlace->division_id = $request->division_id;
        $auctionPlace->district_id = $request->district_id;
        $auctionPlace->upazila_id = $request->upazila_id;
        $auctionPlace->gpsLocation = $request->gpsLocation;
        $auctionPlace->user_id = $request->user_id;
        $auctionPlace->auction_id = Session::get('auction_id');
        $auctionPlace->save();
        
        $sellerDetail = new SellerDetail();
        $sellerDetail->user_id = $request->user_id;
        $sellerDetail->phoneNumber = $request->phoneNumber;
        $sellerDetail->auction_id = Session::get('auction_id');
        $sellerDetail->save();
        
        if ($request->hasFile('adImage1') && $request->hasFile('adImage2') && $request->hasFile('adImage3')) {
            
            $adImage1 = $request->file('adImage1');
            $imageName1 = time().'.'. $adImage1->getClientOriginalName();
            $uploadPath1 = 'public/images/auction/';
            Image::make($adImage1)->resize(200,200);
            $adImage1->move($uploadPath1, $imageName1);
            $imageUrl1 = $uploadPath1 . $imageName1;
            
            $adImage2 = $request->file('adImage2');
            $imageName2 = time().'.'. $adImage2->getClientOriginalName();
            $uploadPath2 = 'public/images/auction/';
            Image::make($adImage2)->resize(200,200);
            $adImage2->move($uploadPath2, $imageName2);
            $imageUrl2 = $uploadPath2 . $imageName2;
            
            $adImage3 = $request->file('adImage3');
            $imageName3 = time().'.'. $adImage3->getClientOriginalName();
            $uploadPath3 = 'public/images/auction/';
            Image::make($adImage3)->resize(200,200);
            $adImage3->move($uploadPath3, $imageName3);
            $imageUrl3 = $uploadPath3 . $imageName3;
            
            $this->saveAuctionImageAllThree($request, $imageUrl1, $imageUrl2, $imageUrl3);
        }elseif ($request->hasFile('adImage1') && $request->hasFile('adImage2')) {
            
            $adImage1 = $request->file('adImage1');
            $imageName1 = time().'.'. $adImage1->getClientOriginalName();
            $uploadPath1 = 'public/images/auction/';
            Image::make($adImage1)->resize(200,200);
            $adImage1->move($uploadPath1, $imageName1);
            $imageUrl1 = $uploadPath1 . $imageName1;
            
            $adImage2 = $request->file('adImage2');
            $imageName2 = time().'.'. $adImage2->getClientOriginalName();
            $uploadPath2 = 'public/images/auction/';
            Image::make($adImage2)->resize(200,200);
            $adImage2->move($uploadPath2, $imageName2);
            $imageUrl2 = $uploadPath2 . $imageName2;
            
            $this->saveAuctionImageFirstTwo($request, $imageUrl1, $imageUrl2);
        }elseif ($request->hasFile('adImage2') && $request->hasFile('adImage3')){
            
            $adImage2 = $request->file('adImage2');
            $imageName2 = time().'.'. $adImage2->getClientOriginalName();
            $uploadPath2 = 'public/images/auction/';
            Image::make($adImage2)->resize(200,200);
            $adImage2->move($uploadPath2, $imageName2);
            $imageUrl2 = $uploadPath2 . $imageName2;
            
            $adImage3 = $request->file('adImage3');
            $imageName3 = time().'.'. $adImage3->getClientOriginalName();
            $uploadPath3 = 'public/images/auction/';
            Image::make($adImage3)->resize(200,200);
            $adImage3->move($uploadPath3, $imageName3);
            $imageUrl3 = $uploadPath3 . $imageName3;
            
            $this->saveAuctionImageLastTwo($request, $imageUrl2, $imageUrl3);
        } elseif ($request->hasFile('adImage1') && $request->hasFile('adImage3')) {
            
            $adImage1 = $request->file('adImage1');
            $imageName1 = time().'.'. $adImage1->getClientOriginalName();
            $uploadPath1 = 'public/images/auction/';
            Image::make($adImage1)->resize(200,200);
            $adImage1->move($uploadPath1, $imageName1);
            $imageUrl1 = $uploadPath1 . $imageName1;

            $adImage3 = $request->file('adImage3');
            $imageName3 = time().'.'. $adImage3->getClientOriginalName();
            $uploadPath3 = 'public/images/auction/';
            Image::make($adImage3)->resize(200,200);
            $adImage3->move($uploadPath3, $imageName3);
            $imageUrl3 = $uploadPath3 . $imageName3;
            
            $this->saveAuctionImagefirstLast($request, $imageUrl1, $imageUrl3);
        } elseif ($request->hasFile('adImage1')) {
            
            $adImage1 = $request->file('adImage1');
            $imageName1 = time().'.'. $adImage1->getClientOriginalName();
            $uploadPath1 = 'public/images/auction/';
            Image::make($adImage1)->resize(200,200);
            $adImage1->move($uploadPath1, $imageName1);
            $imageUrl1 = $uploadPath1 . $imageName1;

            $this->saveAuctionImagefirst($request, $imageUrl1);
        } elseif ($request->hasFile('adImage2')) {
            
            $adImage2 = $request->file('adImage2');
            $imageName2 = time().'.'. $adImage2->getClientOriginalName();
            $uploadPath2 = 'public/images/auction/';
            Image::make($adImage2)->resize(200,200);
            $adImage2->move($uploadPath2, $imageName2);
            $imageUrl2 = $uploadPath2 . $imageName2;

            $this->saveAuctionImageSecond($request, $imageUrl2);
        } elseif ($request->hasFile('adImage3')) {
            
            $adImage3 = $request->file('adImage3');
            $imageName3 = time().'.'. $adImage3->getClientOriginalName();
            $uploadPath3 = 'public/images/auction/';
            Image::make($adImage3)->resize(200,200);
            $adImage3->move($uploadPath3, $imageName3);
            $imageUrl3 = $uploadPath3 . $imageName3;

            $this->saveAuctionImageThird($request, $imageUrl3);
        }
        else
        {
            $this->saveAuctionWithOutImage($request);
        }
        
        return redirect('/profile')->with('message', 'Sir, Your auction info published successfully! Thank you!');
    }
    
    public function saveAuctionImageAllThree($request, $imageUrl1, $imageUrl2, $imageUrl3) {
        
        $auctionImage = new AuctionImage();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
        
    }
    
    public function saveAuctionImageFirstTwo($request, $imageUrl1, $imageUrl2) {
        $auctionImage = new AuctionImage();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    public function saveAuctionImageLastTwo($request, $imageUrl2, $imageUrl3) {
        $auctionImage = new AuctionImage();
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    public function saveAuctionImagefirstLast($request, $imageUrl1, $imageUrl3) {
        $auctionImage = new AuctionImage();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    public function saveAuctionImagefirst($request, $imageUrl1) {
        $auctionImage = new AuctionImage();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    public function saveAuctionImageSecond($request, $imageUrl2) {
        $auctionImage = new AuctionImage();
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    public function saveAuctionImageThird($request, $imageUrl3) {
        $auctionImage = new AuctionImage();
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    public function saveAuctionWithOutImage($request) {
        $auctionImage = new AuctionImage();
        $auctionImage->user_id =  $request->user_id;
        $auctionImage->auction_id = Session::get('auction_id');
        $auctionImage->save();
    }
    
    
}
