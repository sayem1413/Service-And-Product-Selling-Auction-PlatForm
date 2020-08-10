@extends('frontEnd.master1')

@section('title')
Manage Auction Comments
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
            <hr/>
            <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            <hr/>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Comment Details</th>
                        <th>Commented User Profile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auctionComments as $auctionComment)
                    <tr>
                        <td scope="row">{{$auctionComment->id}}</td>
                        <td>{{$auctionComment->commentBody}}</td>
                        <td>
                            <a href="{{url('/user/profile-view/'.$auctionComment->user_id)}}" class="btn btn-info">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>
                        </td>
                        <td>
                            <a href="{{url('/auction/delete-comment/'.$auctionComment->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this comment?')">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$auctionComments->links()}}
        </div>
    </div>
</div>
<hr/>
<hr/>
<br/>
<br/>
@endsection

