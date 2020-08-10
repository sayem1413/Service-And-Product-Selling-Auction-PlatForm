@extends('frontEnd.master1')

@section('title')
Create Profile Info
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
                            <h4>Your Profile Create Page</h4>
                            <hr>
                            <div class="offset-3">
                                <button class="btn btn-success" onClick="getLocation()">Click here to get your GPS Location</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['url'=>'/user-profile/save/', 'method'=>'POST', 'class'=>'form-horizontal','enctype'=>'multipart/form-data' ])!!}
                                <div class="text-center">
                                    <img src="{{asset('public/frontEnd/profile-thum/profile.png')}}" height="200px" width="200px" class="profile img-circle img-thumbnail" alt="avatar">
                                    <h6>Upload a profile photo...</h6>
                                    <input type="file" name="profileImage" id="profileImage" class="text-center center-block file-upload">
                                </div></hr><br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4">User Name</label> 
                                    <div class="col-sm-8">
                                        <input id="username" name="username" class="form-control here" type="text" value="{{Auth::user()->name}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4">Email </label> 
                                    <div class="col-sm-8">
                                        <input id="email" name="email" class="form-control here" type="text" value="{{Auth::user()->email}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Your GPS Location or you add your location Manually</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="output" class="form-control" name="gpsLocation" placeholder="You can add your location Manually">
                                        <br/>
                                        <span class="text-danger" id="error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Your Division</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="divisions" id="divisions">
                                            <option value="" disable="true" selected="true"> Select Division </option>
                                            @foreach ($divisions as $division)
                                            <option value="{{$division->id}}">{{ $division->divisionName }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->has('divisions')?$errors->first('divisions'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Your District</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="districts" id="districts">
                                            <option value="" disable="true" selected="true"> Select District </option>
                                        </select>
                                        <span class="text-danger">{{$errors->has('districts')?$errors->first('districts'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="">Your Upazila</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="upazilas" id="upazilas">
                                            <option value="" disable="true" selected="true"> Select Upazila </option>
                                        </select>
                                        <span class="text-danger">{{$errors->has('upazilas')?$errors->first('upazilas'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Your dealing Address</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="dealingAddress" class="form-control" name="dealingAddress">
                                        <br/>
                                        <span class="text-danger" id="error">{{$errors->has('dealingAddress')?$errors->first('dealingAddress'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Phone Number</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="tel" pattern="(^([+]{1}[8]{2}|0088)?(01){1}[5-9]{1}\d{8})$" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Phone Number" >
                                        <span class="text-danger">{{$errors->has('phoneNumber')?$errors->first('phoneNumber'):''}}</span>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="website" class="col-sm-4">Facebook Link</label> 
                                    <div class="col-sm-8">
                                        <input id="facebookLink" name="facebookLink" placeholder="Facebook Link" class="form-control here" type="text">
                                        <span class="text-danger">{{$errors->has('facebookLink')?$errors->first('facebookLink'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="website" class="col-sm-4">Date Of Birth</label> 
                                    <div class="col-sm-4">
                                        <input id="dateOfBirth" name="dateOfBirth" class="form-control here" type="date">
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="text-danger">{{$errors->has('dateOfBirth')?$errors->first('dateOfBirth'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Personal/Business account</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label><input type="radio" id="userCategory" name="userCategory" value="0">  Personal</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label><input type="radio" id="userCategory" name="userCategory" value="1">  Business</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="text-danger">{{$errors->has('userCategory')?$errors->first('userCategory'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title">Gender</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label><input type="radio" id="gender" name="gender" value="1">  Male</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label><input type="radio" id="gender" name="gender" value="0">  Female</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label><input type="radio" id="gender" name="gender" value="2">  Others</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="text-danger">{{$errors->has('gender')?$errors->first('gender'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-success btn-block">Create My Profile</button>
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
<script type="text/javascript">
    $(document).ready(function () {

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function () {
            readURL(this);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#divisions').on('change', function (e) {
            console.log(e);
            var division_id = e.target.value;
            $.get("{{url('/json-districts')}}?division_id=" + division_id, function (data) {
                console.log(data);
                $('#districts').empty();
                $('#districts').append('<option value="" disable="true" selected="true"> Select District </option>');

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
                $('#upazilas').append('<option value="" disable="true" selected="true"> Select Upazila </option>');

                $.each(data, function (index, UpazialsObj) {
                    $('#upazilas').append('<option value="' + UpazialsObj.id + '">' + UpazialsObj.upazilaName + '</option>');
                });
            });
        });
    });

    var x = document.getElementById('output');
    var y = document.getElementById('error');
    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else
        {
            y.innerHTML = "Your browser not supporting!";
        }
    }

    function showPosition(position)
    {
        // x.innerHTML = "latitude = "+position.coords.latitude;
        // x.innerHTML += "<br/>";
        // x.innerHTML += "longitude = "+position.coords.longitude;

        var locAPI = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&sensor=true";

        // x.innerHTML = locAPI;

        $.get({
            url: locAPI,
            success: function (data) {
                console.log(data);
                x.value = data.results[0].address_components[1].long_name;
//				x.innerHTML += data.results[0].address_components[2].long_name+", ";
//				x.innerHTML += data.results[0].address_components[3].long_name+", ";
//				x.innerHTML += data.results[0].address_components[4].long_name+", ";
//				x.innerHTML += data.results[0].address_components[5].long_name;
            }
        });

    }

    function showError(error)
    {
        switch (error.code)
        {
            case error.PERMISSION_DENIED :
                y.innerHTML = "Error 1 : " + error.code + "User dont want to share location!";
                break;

            case error.POSITION_UNAVAILABLE :
                y.innerHTML = "Error 2 : " + error.code + "location unavailable!";
                break;

            case error.TIMEOUT :
                y.innerHTML = "Error 3 : " + error.code + "request timed out!";
                break;

            case error.UNKNOWN_ERROR :
                y.innerHTML = "Error 4 : " + error.code + "Unknown error!";
                break;

        }
    }
</script>
@endsection

