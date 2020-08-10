@extends('frontEnd.master2')

@section('title')
{{$user->name}}
@endsection

@section('mainContent')
@if ($userAddress || $userInfo)
<div class="container-fluid">
    <div class="row-border">
        <div class="col-md-2">
    
        </div>
        <div class="col-md-8">
            <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            <hr/>
            @if($userInfo->profileImage)
            <div align="center"> <img alt="User Pic" src="{{asset($userInfo->profileImage)}}" height="200px" width="200px" alt="Profile Image" class="img-circle img-responsive"> </div>
            @else
            <div align="center"> <img alt="User Pic" src="{{asset('public/frontEnd/profile-thum/profile.png')}}" class="img-circle img-responsive"> </div>
            @endif
            <table class="table table-user-information table-hover table-striped" style="margin-top: 50px;">
                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td>{{$userInfo->dateOfBirth}}</td>
                    </tr>
                    <tr>
                        <td>Gender: </td>
                        <td>
                            @if($userInfo->gender === 0)
                            {{'Women'}}
                            @elseif($userInfo->gender === 1)
                            {{'Men'}}
                            @elseif($userInfo->gender === 2)
                            {{'Others'}}
                            @else
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Home Address</td>
                        <td><p>@if($userUpazila)
                                {{$userUpazila->upazilaName}},
                                @else
                            <p></p>
                            @endif
                            @if($userDistrict)
                            {{$userDistrict->districtName}},
                            @else
                            <p></p>
                            @endif 
                            @if($userDivision)
                            {{$userDivision->divisionName}}
                            @else
                            <p></p>
                            @endif
                            </p>
                    </tr>
                    <tr>
                        <td>Delaing/Business Address</td>
                        <td>{{$userAddress->dealingAddress}}</td>
                    </tr>
                    <tr>
                        <td>GPS Location: </td>
                        <td>{{$userAddress->gpsLocation}}</td>
                    </tr>
                    <tr>
                        <td>User Category</td>
                        <td>
                        @if($userInfo->userCategory === 1)
                        {{'Professional Business Purpose'}}
                        @elseif($userInfo->userCategory === 0)
                        {{'Personal Business Purpose'}}
                        @else
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>{{$userInfo->phoneNumber}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-md-2">
    
        </div>
    </div>
</div>

@else
<div class="container-fluid">
    <div class="row-border">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-8">
            <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            <hr/>
            <div align="center"> <img alt="User Pic" src="{{asset('public/frontEnd/profile-thum/profile.png')}}" class="img-circle img-responsive"> </div>

            <table class="table table-user-information"  style="margin-top: 50px;">
                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Gender: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Home Address</td>
                        <td><p></p></td>
                    </tr>
                    <tr>
                        <td>Delaing/Business Address</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>GPS Location: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-md-2">
    
        </div>
    </div>
</div>
@endif
@endsection


