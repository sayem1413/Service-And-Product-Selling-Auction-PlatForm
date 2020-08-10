@extends('frontEnd.master1')

@section('title')
Edit Bid
@endsection

@section('mainContent')
<div class="container container-fluid" style="margin-top: 50px; height: 600px;">
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
                                @if ($userAddress && $userInfo)
                                    <li>
                                        <a href="{{url('/user-profile/edit/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Edit Profile</a>
                                    </li>
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
                                    @if($cardInfo)
                                    <li>
                                        <a href="{{url('/user/payment-form/edit/')}}"><i class="fa fa-credit-card"></i> Edit Card Info</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{url('/user/payment-form/')}}"><i class="fa fa-credit-card"></i> Auction Payment</a>
                                    </li>
                                    @endif
                                @else
                                    <li>
                                        <a href="{{url('/user-profile/create/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Create Profile Info</a>
                                    </li>
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
                                    @if($cardInfo)
                                    <li>
                                        <a href="{{url('/user/payment-form/edit/')}}"><i class="fa fa-credit-card"></i> Edit Card Info</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{url('/user/payment-form/')}}"><i class="fa fa-credit-card"></i> Auction Payment</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Your Bid Edit Page</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['url'=>'/user-bid/update/', 'method'=>'POST', 'class'=>'form-horizontal'])!!}
                            
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" value="{{$bid->id}}" id="id" name="id">
                                        <input type="hidden" value="{{$bid->auction_id}}" id="auction_id" name="auction_id">
                                        <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">
                                        <input id="userName" name="userName" class="form-control here" type="hidden" value="{{Auth::user()->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bid" class="col-sm-4">Your Bidding Price</label> 
                                    <div class="col-sm-8">
                                        <input type="number" value="{{$bid->fee}}" min="{{$auctionPrice->price}}" class="form-control" name="price" id="price" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8">
                                        <button name="submit" type="submit" class="btn btn-success btn-block">Update Bid amount</button>
                                    </div>
                                </div>
                            {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
