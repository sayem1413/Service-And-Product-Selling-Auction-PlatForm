@extends('frontEnd.master1')

@section('title')
Auction Edit
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
            <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            <hr/>
            <div class="well">
                {!! Form::open(['url'=>'/user/auction-update', 'method'=>'POST', 'class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'editAuctionForm' ])!!}
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" value="{{$userAuctionById->id}}" id="auction_id" name="auction_id">
                        <input type="hidden" value="{{$userAuctionById->user_id}}" id="user_id" name="user_id">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your GPS Location </label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" value="{{$userAuctionById->gpsLocation}}" id="gpsLocation" class="form-control" name="gpsLocation">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Selected Category</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="categories" id="categories">
                            <option value="0" disable="true" selected="true"> Select Category </option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{$errors->has('categories')?$errors->first('categories'):''}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Selected Sub-Category</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="subcategories" id="subcategories">
                            <option value="0" disable="true"> Select Sub-Category </option>
                            <option value="{{$userAuctionById->subcategory_id}}" disable="true" selected="true">{{$userAuctionById->subCategoryName}}</option>
                        </select>
                        <span class="text-danger">{{$errors->has('subcategories')?$errors->first('subcategories'):''}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Selected Division</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="divisions" id="divisions">
                            <option value="0" disable="true" selected="true"> Select Division </option>
                            @foreach ($divisions as $division)
                            <option value="{{$division->id}}">{{ $division->divisionName }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{$errors->has('divisions')?$errors->first('divisions'):''}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Selected District</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="districts" id="districts">
                            <option value="0" disable="true"> Select District </option>
                            <option value="{{$userAuctionById->district_id}}" disable="true" selected="true">{{$userAuctionById->districtName}}</option>
                        </select>
                        <span class="text-danger">{{$errors->has('districts')?$errors->first('districts'):''}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Upazila or Thana</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" name="upazilas" id="upazilas">
                            <option value="0" disable="true"> Select Upazila </option>
                            <option value="{{$userAuctionById->upazila_id}}" disable="true" selected="true">{{$userAuctionById->upazilaName}}</option>
                        </select>
                        <span class="text-danger">{{$errors->has('upazilas')?$errors->first('upazilas'):''}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="title">Your Ad Images</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="file" id="adImageInput1" class="form-control" name="adImage1" >
                        <br/>
                        <span><img src="{{asset($userAuctionById->adImage1)}}" id="adImage1"  height="170px" width="150px" ></span>
                    </div>
                    <div class="col-sm-3">
                        <input type="file" id="adImageInput2" class="form-control" name="adImage2" >
                        <br/>
                        <span><img src="{{asset($userAuctionById->adImage2)}}" id="adImage2"  height="170px" width="150px" ></span>
                    </div>
                    <div class="col-sm-3">
                        <input type="file" id="adImageInput3" class="form-control" name="adImage3" >
                        <br/>
                        <span><img src="{{asset($userAuctionById->adImage3)}}" id="adImage3"  height="170px" width="150px" ></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Advertisement Title</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" value="{{$userAuctionById->auctionTitle}}" placeholder="Product Title here" id="auctionTitle" class="form-control" name="auctionTitle" >
                        <span class="text-danger">{{$errors->has('auctionTitle')?$errors->first('auctionTitle'):''}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Product Condition</label>
                    </div>
                    <div class="col-sm-2">
                        <label><input type="radio" id="condition" name="condition" value="0"{{$userAuctionById->condition == 0 ? 'checked' : ''}}>  New</label>
                    </div>
                    <div class="col-sm-2">
                        <label><input type="radio" id="condition" name="condition" value="1"{{$userAuctionById->condition == 1 ? 'checked' : ''}}>  Used</label>
                    </div>
                    <div class="col-sm-4">
                        <span class="text-danger">{{$errors->has('condition')?$errors->first('condition'):''}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Price</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"value="{{$userAuctionById->price}}" name="price" id="price" class="form-control" >
                        <span class="text-danger">{{$errors->has('price')?$errors->first('price'):''}}</span>
                    </div>
                    <div class="col-sm-4">
                        <label><input type="checkbox" id="negotiable" name="negotiable" value="1"{{$userAuctionById->negotiable == 1 ? 'checked' : ''}}>  Negotiable</label>
                    </div>
                </div>
                
                <div class="form-group" id="auctionExpiryDateDiv">
                    <div class="col-sm-4">
                        <label for="title">Auction Expiry Date </label>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" value="{{$userAuctionById->auctionExpiryDate}}" id="auctionExpiryDate" class="form-control" name="auctionExpiryDate">
                        <span class="text-danger">{{$errors->has('auctionExpiryDate')?$errors->first('auctionExpiryDate'):''}}</span>
                    </div>
                    <div class="col-sm-4">
                        <label style="color: red;"></label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Your Advertisement Description</label>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="auctionDescription" name="auctionDescription" rows="14">{{$userAuctionById->auctionDescription}}</textarea>
                        <span class="text-danger">{{$errors->has('auctionDescription')?$errors->first('auctionDescription'):''}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="title">Phone Number</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="tel" value="{{$userAuctionById->phoneNumber}}" name="phoneNumber" id="phoneNumber" class="form-control" >
                        <span class="text-danger">{{$errors->has('phoneNumber')?$errors->first('phoneNumber'):''}}</span>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-1">
                        <label for="title">Name</label>
                    </div>
                    <div class="col-sm-5">
                        <label class="label-info">{{$userAuctionById->name}}</label>
                    </div>
                    <div class="col-sm-1">
                        <label for="title">Email</label>
                    </div>
                    <div class="col-sm-5">
                        <label class="label-info">{{$userAuctionById->email}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-success btn-block" name="">Update Your Advertisement or Auction Details</button>
                    </div>
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>
<hr/>

<script>
    document.forms['editAuctionForm'].elements['categories'].value = {{$userAuctionById->category_id}};
    document.forms['editAuctionForm'].elements['divisions'].value = {{$userAuctionById->division_id}};
    
    $(document).ready(function () {
        $('#categories').on('change', function (e) {
            console.log(e);
            var category_id = e.target.value;
            $.get("{{url('/json-subcategories')}}?category_id=" + category_id, function (data) {
                console.log(data);
                $('#subcategories').empty();
                $('#subcategories').append('<option value="0" disable="true" selected="true"> Select Sub-Category </option>');

                $.each(data, function (index, SubCategoryObj) {
                    $('#subcategories').append('<option value="' + SubCategoryObj.id + '">' + SubCategoryObj.subCategoryName + '</option>');
                });
            });
        });

        $('#divisions').on('change', function (e) {
            console.log(e);
            var division_id = e.target.value;
            $.get("{{url('/json-districts')}}?division_id=" + division_id, function (data) {
                console.log(data);
                $('#districts').empty();
                $('#districts').append('<option value="0" disable="true" selected="true"> Select District </option>');

                $.each(data, function (index, districtsObj) {
                    $('#districts').append('<option value="' + districtsObj.id + '">' + districtsObj.districtName + '</option>');
                });
            });
        });
        $('#districts').on('change', function (e) {
            console.log(e);
            var district_id = e.target.value;
            $.get("{{url('/json-upazilas')}}?district_id=" + district_id, function (data) {
                console.log(data);
                $('#upazilas').empty();
                $('#upazilas').append('<option value="0" disable="true" selected="true"> Select Upazila </option>');

                $.each(data, function (index, UpazialsObj) {
                    $('#upazilas').append('<option value="' + UpazialsObj.id + '">' + UpazialsObj.upazilaName + '</option>');
                });
            });
        });
    });
    
    function readURL1(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adImage1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#adImageInput1").change(function () {
        readURL1(this);
    });

    function readURL2(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adImage2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#adImageInput2").change(function () {
        readURL2(this);
    });

    function readURL3(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adImage3').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#adImageInput3").change(function () {
        readURL3(this);
    });
    
    
</script>

@endsection

