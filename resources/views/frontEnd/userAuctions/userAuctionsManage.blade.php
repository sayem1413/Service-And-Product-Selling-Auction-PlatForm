@extends('frontEnd.master1')

@section('title')
User Auction Manage
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
                                @if (count($userAddress) === 1 && count($userInfo) === 1)
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
                                    @if(count($cardInfo) === 1)
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
                                    @if(count($cardInfo) === 1)
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
            <hr/>
            <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            <hr/>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Auction Id</th>
                        <th>Auction Title</th>
                        <th>Auction Description</th>
                        <th>Condition</th>
                        <th>Price</th>
                        <th>Negotiation</th>
                        <th>Auction Pictures</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userAuctions as $userAuction)
                    <tr>
                        <td scope="row">{{$userAuction->id}}</td>
                        <td>{{$userAuction->auctionTitle}}</td>
                        <td>{{$userAuction->auctionDescription}}</td>
                        <td>{{$userAuction->condition == 1 ? 'Used':'New' }}</td>
                        <td>{{$userAuction->price}}</td>
                        <td>{{$userAuction->negotiable == 1 ? 'Negotiable':'Fixed' }}</td>
                        <td><img src="{{asset($userAuction->adImage1)}}" alt="" height="100px" width="100px">
                            <br/><hr/><img src="{{asset($userAuction->adImage2)}}" alt="" height="100px" width="100px">
                            <br/><hr/><img src="{{asset($userAuction->adImage3)}}" alt="" height="100px" width="100px">
                        </td>
                        <td>
                            <a href="{{url('/user/auction-edit/'.$userAuction->id)}}" class="btn btn-success">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="{{url('/user/auction-delete/'.$userAuction->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$userAuctions->links()}}
        </div>
    </div>
</div>
<hr/>
<hr/>
<br/>
<br/>
@endsection