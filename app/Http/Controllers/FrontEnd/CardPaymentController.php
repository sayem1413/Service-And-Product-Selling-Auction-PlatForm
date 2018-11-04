<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\UserAddress;
use App\UserInfo;
use App\CardInfo;
use DB;

class CardPaymentController extends Controller
{
    //
    
    public function addPaymentCardForm() {
        
        $id = Auth::user()->id;
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();
        return view('frontEnd.cardPayment.cardPayment',['cardInfo' => $cardInfo,'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }
    
    public function savePaymentCardInfo(Request $request) {
        $this->validate($request, [
            'cardNumber' => 'required',
            'cvv' => 'required',
            'expirationDate' => 'required',
        ]);
        
        $cardInfo = new CardInfo();
        $cardInfo->cardNumber = $request->cardNumber;
        $cardInfo->cvv = $request->cvv;
        $cardInfo->expirationDate = $request->expirationDate;
        $cardInfo->user_id = $request->user_id;
        $cardInfo->save();
        
        return redirect('/profile')->with('message', 'Sir, Your Card info Saved successfully! Thank you!');
    }
    
    public function editPaymentCardInfo() {
        $id = Auth::user()->id;
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();
        return view('frontEnd.cardPayment.editCardPayment',['cardInfo' => $cardInfo,'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }
    
    public function updatePaymentCardInfo(Request $request) {
        $this->validate($request, [
            'cardNumber' => 'required',
            'cvv' => 'required',
            'expirationDate' => 'required',
        ]);
        
        $id = $request->user_id;
        
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $cardInfo->cardNumber = $request->cardNumber;
        $cardInfo->cvv = $request->cvv;
        $cardInfo->expirationDate = $request->expirationDate;
        $cardInfo->user_id = $id;
        $cardInfo->save();
        
        return redirect('/profile')->with('message', 'Sir, Your Card info updated successfully! Thank you!');
    }
    
}
