@extends('frontEnd.master3')

@section('title')
Edit Payment Card
@endsection

@section('mainContent')
<div class="container container-fluid" style="margin-top: 50px; margin-bottom: 200px; height: 600px;">
    <div class="row row-border">
        <div class="col-md-3">
            <div class="sidebar sidebar-nav">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search.">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{url('/profile')}}"><i class="fa fa-home"></i> My Profile<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if (count($userAddress) === 1 && count($userInfo) === 1)
                                <li>
                                    <a href="{{url('/user-profile/edit/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Edit Profile</a>
                                </li>
                                @else
                                <li>
                                    <a href="{{url('/user-profile/create/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Create Profile Info</a>
                                </li>
                                @endif
                                <li>
                                    <a href="#"><span class="fa fa-list"></span> Activity Comment & Favourites</a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{url('/user/activity/'.Auth::user()->id)}}"><span class="fa fa-arrow-right"></span>Comment</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{url('/auctions-manage/user/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Manage Advertisements</a>
                                </li>
                                <li>
                                    <a href="{{url('/user/manage-bids/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Manage Your Bids</a>
                                </li>
                                @if(count($cardInfo) === 1)
                                <li>
                                    <a href="{{url('/user/payment-form/edit/')}}"><i class="fa fa-credit-card"></i> Edit Card Info</a>
                                </li>
                                @else
                                <li>
                                    <a href="{{url('/user/payment-form/')}}"><i class="fa fa-credit-card"></i> Auction Payment</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="container-fluid">
                <div class="creditCardForm">
                    <div class="heading">
                        <h1>Add Card Info for Auction</h1>
                    </div>
                    <div class="payment">
                        {!! Form::open(['url'=>'/user/payment-info/update/', 'method'=>'POST'])!!}
                            <div class="form-group" id="card-number-field">
                                <label for="cardNumber">Card Number</label>
                                <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">
                                <input type="text" class="form-control" value="{{$cardInfo->cardNumber}}" id="cardNumber" name="cardNumber">
                                <span id="cardNumberError">{{$errors->has('cardNumber')?$errors->first('cardNumber'):''}}</span>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" value="{{$cardInfo->cvv}}" class="form-control" id="cvv" name="cvv">
                                <span id="cvvError">{{$errors->has('cvv')?$errors->first('cvv'):''}}</span>
                            </div>    
                            <div class="form-group" id="expiration-date" style="float: right;">
                                <label>Expiration Date</label>
                                <input type="date" class="form-control" value="{{$cardInfo->expirationDate}}" min="2019-01-01" id="expiration" name="expirationDate">
                                <span id="expirationError">{{$errors->has('expirationDate')?$errors->first('expirationDate'):''}}</span>

                                <!-- <select>
                                    <option value="01">January</option>
                                    <option value="02">February </option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <select>
                                    <option value="16"> 2016</option>
                                    <option value="17"> 2017</option>
                                    <option value="18"> 2018</option>
                                    <option value="19"> 2019</option>
                                    <option value="20"> 2020</option>
                                    <option value="21"> 2021</option>
                                </select> -->
                            </div>
                            <div class="form-group" id="credit_cards"  style="float: right;">
                                <img src="{{asset('public/frontEnd/card-assets/images/visa.jpg')}}" id="visa">
                                <img src="{{asset('public/frontEnd/card-assets/images/mastercard.jpg')}}" id="mastercard">
                                <img src="{{asset('public/frontEnd/card-assets/images/amex.jpg')}}" id="amex">
                            </div>
                            <div class="form-group" id="pay-now">
                                <button type="submit" class="btn btn-default" id="confirm-purchase">Save Information</button>
                            </div>
                            <div class="form-group" id="pay-now">
                                <a href="{{url('/user/payment-info/delete/'.Auth::user()->id)}}" class="btn btn-danger btn-block" style="background-color: red;">Delete Information</a>
                            </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>

            <script src="{{asset('public/frontEnd/card-assets/js/jquery.payform.min.js')}}" charset="utf-8"></script>
            <script src="{{asset('public/frontEnd/card-assets/js/script.js')}}"></script>
        </div>
    </div>
</div>


@endsection

