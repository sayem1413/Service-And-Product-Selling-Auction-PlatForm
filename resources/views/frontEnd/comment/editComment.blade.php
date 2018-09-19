@extends('frontEnd.master1')

@section('title')
Edit Comment
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
                                            <li>
                                                <a href="#"><span class="fa fa-arrow-right"></span>Faviourites</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{url('/auctions-manage/user/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Manage Advertisements</a>
                                    </li>
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
                                            <li>
                                                <a href="#"><span class="fa fa-arrow-right"></span>Faviourites</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{url('/auctions-manage/user/'.Auth::user()->id)}}"><i class="fa fa-edit"></i> Manage Advertisements</a>
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Your Profile</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['url'=>'/user-comment/update/', 'method'=>'POST', 'class'=>'form-horizontal'])!!}
                            
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" value="{{$comment->id}}" id="id" name="id">
                                        <input type="hidden" value="{{$comment->auction_id}}" id="auction_id" name="auction_id">
                                        <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">
                                        <input id="userName" name="userName" class="form-control here" type="hidden" value="{{Auth::user()->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4">Your Comment</label> 
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="commentBody" id="commentBody" cols="15" style="height: 100px; width: 320px;">{{$comment->commentBody}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <button name="submit" type="submit" class="btn btn-success">Update Comment</button>
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

