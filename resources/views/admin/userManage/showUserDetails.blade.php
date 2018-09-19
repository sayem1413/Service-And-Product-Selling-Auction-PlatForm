@extends('admin.master')

@section('title')
User - {{$user->name}}
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <tr>
        <th>Profile Image</th>
        @if(count($userInfo) === 1)
            @if(count($userInfo->profileImage) === 1)
            <th><img src="{{asset($userInfo->profileImage)}}" alt="{{$user->name}}" height="250px" width="250" ></th>
            @else
             <th><img src="{{asset('public/frontEnd/profile-thum/profile.png')}}" alt="{{$user->name}}" height="250px" width="250" ></th>
            @endif
        @else
        <th><img src="{{asset('public/frontEnd/profile-thum/profile.png')}}" alt="{{$user->name}}" height="250px" width="250" ></th>
        @endif
    </tr>
    <tr>
        <th>User Id</th>
        <th>{{$user->id}}</th>
    </tr>
    <tr>
        <th>User Name</th>
        <th>{{$user->name}}</th>
    </tr>
    <tr>
        <th>User Email</th>
        <th>{{$user->email}}</th>
    </tr>
    <tr>
        <th>User Phone Number</th>
        @if(count($userInfo) === 1)
            @if(count($userInfo->profileImage) === 1)
            <th>{{$userInfo->phoneNumber}}</th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>
    <tr>
        <th>User Date Of Birth</th>
        @if(count($userInfo) === 1)
            @if(count($userInfo->dateOfBirth) === 1)
            <th>{{$userInfo->dateOfBirth}}</th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>
    <tr>
        <th>User gender</th>
        @if(count($userInfo) === 1)
            @if(count($userInfo->gender) === 1)
            <th>{{$userInfo->gender == 1 ? 'Men':'Women' }}</th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>
    <tr>
        <th>Account Category</th>
        @if(count($userInfo) === 1)
            @if(count($userInfo->userCategory) === 1)
            <th>{{$userInfo->userCategory == 1 ? 'Professional Business Purpose':'Personal Business Purpose' }}</th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>
    <tr>
        <th>Dealing Address</th>
        @if(count($userAddress) === 1)
            @if(count($userAddress->dealingAddress) === 1)
            <th>{{$userAddress->dealingAddress}}</th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>
    <tr>
        <th>Address</th>
        <th>
            <p>@if(count($userUpazila) === 1)
                {{$userUpazila->upazilaName}},
                @else
                <p></p>
                @endif
                @if(count($userDistrict) === 1)
                {{$userDistrict->districtName}},
                @else
                <p></p>
                @endif 
                @if(count($userDivision) === 1)
                {{$userDivision->divisionName}}
                @else
                <p></p>
                @endif
                </p>
        </th>
    </tr>
    <tr>
        <th>GPS Location</th>
        @if(count($userAddress) === 1)
            @if(count($userAddress->gpsLocation) === 1)
            <th>{{$userAddress->gpsLocation}}</th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>
    <tr>
        <th>User Facebook Account</th>
        @if(count($userAddress) === 1)
            @if(count($userAddress->facebookLink) === 1)
            <th><a href="{{asset($userInfo->facebookLink)}}">{{$user->name}}</a></th>
            @else
            <th></th>
            @endif
        @else
        <th></th>
        @endif
    </tr>

</table>

@endsection
