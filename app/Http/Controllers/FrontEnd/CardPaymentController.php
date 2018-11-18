<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserAddress;
use App\UserInfo;
use App\CardInfo;
use App\Bid;
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
            'cardNumber' => 'required|unique:card_infos',
            'cvv' => 'required',
            'expirationDate' => 'required',
        ]);
        
        $cardInfo = new CardInfo();
        $cardInfo->cardNumber = $request->cardNumber;
        $cardInfo->cvv = $request->cvv;
        $cardInfo->expirationDate = $request->expirationDate;
        $cardInfo->user_id = $request->user_id;
        $cardInfo->save();
        
        $card_id = $cardInfo->id;
        Session::put('card_id', $card_id);
        
        $user = User::where('id',$request->user_id)->first();
        $user->card_id = Session::get('card_id');
        $user->save();
        
        
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
            'cardNumber' => 'required|unique:card_infos',
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
    
    public function deletePaymentCardInfo($id) {
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $cardInfo->delete();
        $user = User::where('id',$id)->first();
        $user->card_id = NULL;
        $user->save();
        
        $bids = Bid::where('user_id',$id)->get();
        
        foreach($bids as $bid){
            $bid->delete();
        }
        return redirect('/profile')->with('message', 'Sir, Your Card info Deleted successfully! Thank you!');
        
        
    }
    
}
