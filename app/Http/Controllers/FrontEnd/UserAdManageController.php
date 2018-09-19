<?php

namespace App\Http\Controllers\FrontEnd;

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
use App\User;
use App\UserAddress;
use App\UserInfo;
use DB;
use Intervention\Image\Facades\Image;

class UserAdManageController extends Controller {

    public function manageUserAuction($id) {
        $userAuctions = DB::table('all_auction_details_views')
                ->select('all_auction_details_views.*')
                ->where('all_auction_details_views.user_id', $id)
                ->paginate(2);
        
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();

        return view('frontEnd.userAuctions.userAuctionsManage', ['userAuctions' => $userAuctions, 'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }

    public function editUserAuction($id) {

        $categories = Category::all();
        $divisions = Division::all();

        $userAuctionById = DB::table('all_auction_details_views')
                ->select('all_auction_details_views.*')
                ->where('all_auction_details_views.id', $id)
                ->first();
        
        
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();

//        $userAuctionById = DB::table('auction_details')
//                            ->join('auction_categories', 'auction_categories.auction_id', '=', 'auction_details.id')
//                            ->join('auction_places', 'auction_places.auction_id', '=', 'auction_details.id')
//                            ->join('auction_images', 'auction_images.auction_id', '=', 'auction_details.id')
//                            ->join('seller_details', 'seller_details.auction_id', '=', 'auction_details.id')
//                            ->select('auction_details.*','auction_categories.category_id', 'auction_categories.subcategory_id','auction_places.division_id', 'auction_places.district_id', 'auction_places.upazila_id','auction_images.adImage1', 'auction_images.adImage2', 'auction_images.adImage2')
//                            ->where('auction_details.id', $id)
//                            ->first();

        return view('frontEnd.userAuctions.userAuctionsEdit', ['userAuctionById' => $userAuctionById, 'categories' => $categories, 'divisions' => $divisions, 'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }

    public function updateUserAuction(Request $request) {
        $this->validate($request, [
            'categories' => 'required|not_in:0',
            'subcategories' => 'required|not_in:0',
            'divisions' => 'required|not_in:0',
            'districts' => 'required|not_in:0',
            'upazilas' => 'required|not_in:0',
            'auctionTitle' => 'required',
            'auctionDescription' => 'required',
            'condition' => 'required|in:0,1',
            'price' => 'required',
            'phoneNumber' => 'required',
        ]);

        $auctionDetail = AuctionDetail::where('id', $request->auction_id)->first();
        $auctionDetail->auctionTitle = $request->auctionTitle;
        $auctionDetail->auctionDescription = $request->auctionDescription;
        $auctionDetail->condition = $request->condition;
        $auctionDetail->price = $request->price;
        if ($request->negotiable == 1) {
            $auctionDetail->negotiable = $request->negotiable;
        }
        $auctionDetail->save();

        $auctionCategory = AuctionCategory::where('auction_id', $request->auction_id)->first();
        $auctionCategory->category_id = $request->categories;
        $auctionCategory->subcategory_id = $request->subcategories;
        $auctionCategory->auction_id = $request->auction_id;
        $auctionCategory->save();

        $auctionPlace = AuctionPlace::where('auction_id', $request->auction_id)->first();
        $auctionPlace->division_id = $request->divisions;
        $auctionPlace->district_id = $request->districts;
        $auctionPlace->upazila_id = $request->upazilas;
        $auctionPlace->gpsLocation = $request->gpsLocation;
        $auctionPlace->auction_id = $request->auction_id;
        $auctionPlace->save();

        $sellerDetail = SellerDetail::where('auction_id', $request->auction_id)->first();
        $sellerDetail->user_id = $request->user_id;
        $sellerDetail->phoneNumber = $request->phoneNumber;
        $sellerDetail->auction_id = $request->auction_id;
        $sellerDetail->save();

        if ($request->hasFile('adImage1') && $request->hasFile('adImage2') && $request->hasFile('adImage3')) {

            $imageUrl1 = $this->firstImageExistStatus($request);
            $imageUrl2 = $this->secondImageExistStatus($request);
            $imageUrl3 = $this->thirdImageExistStatus($request);

            $this->updateAuctionImageAllThree($request, $imageUrl1, $imageUrl2, $imageUrl3);
        } elseif ($request->hasFile('adImage1') && $request->hasFile('adImage2')) {


            $imageUrl1 = $this->firstImageExistStatus($request);
            $imageUrl2 = $this->secondImageExistStatus($request);

            $this->updateAuctionImagefirstTwo($request, $imageUrl1, $imageUrl2);
        } elseif ($request->hasFile('adImage2') && $request->hasFile('adImage3')) {


            $imageUrl2 = $this->secondImageExistStatus($request);
            $imageUrl3 = $this->thirdImageExistStatus($request);

            $this->updateAuctionImageLastTwo($request, $imageUrl2, $imageUrl3);
        } elseif ($request->hasFile('adImage1') && $request->hasFile('adImage3')) {


            $imageUrl1 = $this->firstImageExistStatus($request);
            $imageUrl3 = $this->thirdImageExistStatus($request);

            $this->updateAuctionImageFirstLast($request, $imageUrl1, $imageUrl3);
        } elseif ($request->hasFile('adImage1')) {

            $imageUrl1 = $this->firstImageExistStatus($request);

            $this->updateAuctionImageFirst($request, $imageUrl1);
        } elseif ($request->hasFile('adImage2')) {

            $imageUrl2 = $this->secondImageExistStatus($request);

            $this->updateAuctionImageSecond($request, $imageUrl2);
        } elseif ($request->hasFile('adImage3')) {

            $imageUrl3 = $this->thirdImageExistStatus($request);

            $this->updateAuctionImageThird($request, $imageUrl3);
        } else {

            $this->updateAuctionWithOutImage($request);
        }

        return redirect('/profile')->with('message', 'Sir, Your auction info updated successfully! Thank you!');
    }

    public function firstImageExistStatus($request) {

        $auctionImageById = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage1 = $request->file('adImage1');
        $oldImage1 = $auctionImageById->adImage1;

        if ($auctionImage1) {
            if ($oldImage1) {
                unlink($oldImage1);
            }
            $imageName1 = time() . '.' . $auctionImage1->getClientOriginalName();
            $uploadPath1 = 'public/images/auction/';
            Image::make($auctionImage1)->resize(200, 200);
            $auctionImage1->move($uploadPath1, $imageName1);
            $imageUrl1 = $uploadPath1 . $imageName1;
        } else {
            $imageUrl1 = $auctionImageById->adImage1;
        }
        return $imageUrl1;
    }

    public function secondImageExistStatus($request) {

        $auctionImageById = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage2 = $request->file('adImage2');

        $oldImage2 = $auctionImageById->adImage2;

        if ($auctionImage2) {
            if ($oldImage2) {
                unlink($oldImage2);
            }
            $imageName2 = time() . '.' . $auctionImage2->getClientOriginalName();
            $uploadPath2 = 'public/images/auction/';
            Image::make($auctionImage2)->resize(200, 200);
            $auctionImage2->move($uploadPath2, $imageName2);
            $imageUrl2 = $uploadPath2 . $imageName2;
        } else {
            $imageUrl2 = $auctionImageById->adImage2;
        }
        return $imageUrl2;
    }

    public function thirdImageExistStatus($request) {

        $auctionImageById = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage3 = $request->file('adImage3');

        $oldImage3 = $auctionImageById->adImage3;

        if ($auctionImage3) {
            if ($oldImage3) {
                unlink($oldImage3);
            }
            $imageName3 = time() . '.' . $auctionImage3->getClientOriginalName();
            $uploadPath3 = 'public/images/auction/';
            Image::make($auctionImage3)->resize(200, 200);
            $auctionImage3->move($uploadPath3, $imageName3);
            $imageUrl3 = $uploadPath3 . $imageName3;
        } else {
            $imageUrl3 = $auctionImageById->adImage3;
        }
        return $imageUrl3;
    }

    public function updateAuctionImageAllThree($request, $imageUrl1, $imageUrl2, $imageUrl3) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionImagefirstTwo($request, $imageUrl1, $imageUrl2) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionImageLastTwo($request, $imageUrl2, $imageUrl3) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionImageFirstLast($request, $imageUrl1, $imageUrl3) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionImageFirst($request, $imageUrl1) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage1 = $imageUrl1;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionImageSecond($request, $imageUrl2) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage2 = $imageUrl2;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionImageThird($request, $imageUrl3) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->adImage3 = $imageUrl3;
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
    }

    public function updateAuctionWithOutImage($request) {

        $auctionImage = AuctionImage::where('auction_id', $request->auction_id)->first();
        $auctionImage->auction_id = $request->auction_id;
        $auctionImage->save();
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
        

        return redirect('/profile')->with('message', 'Sir, Your auction info deleted successfully! Thank you!');
    }

}
