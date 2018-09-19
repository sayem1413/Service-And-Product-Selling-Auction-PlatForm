@extends('admin.master')

@section('title')
User Auction Details
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <tr>
        <th>Auction Id</th>
        <th>{{$userAuctionById->id}}</th>
    </tr>
    <tr>
        <th>Auction Title</th>
        <th>{{$userAuctionById->auctionTitle}}</th>
    </tr>
    <tr>
        <th>Auction Condition</th>
        <th>{{$userAuctionById->condition == 1 ? 'Used':'New' }}</th>
    </tr>
    <tr>
        <th>Auction Price</th>
        <th>{{$userAuctionById->price}} taka</th>
    </tr>
    <tr>
        <th>Auction Negotiation</th>
        <th>{{$userAuctionById->condition == 1 ? 'Negotiable':'Fixed' }}</th>
    </tr>
    <tr>
        <th>Auction Image 1</th>
        <th><img src="{{asset($userAuctionById->adImage1)}}" height="250px" width="250" ></th>
    </tr>
    <tr>
        <th>Auction Image 2</th>
        <th><img src="{{asset($userAuctionById->adImage2)}}" height="250px" width="250" ></th>
    </tr>
    <tr>
        <th>Auction Image 3</th>
        <th><img src="{{asset($userAuctionById->adImage3)}}" height="250px" width="250" ></th>
    </tr>
    <tr>
        <th>Auction Description</th>
        <th>{{$userAuctionById->auctionDescription}}</th>
    </tr>
    <tr>
        <th>Auction Location</th>
        <th>{{$userAuctionById->gpsLocation}}, {{$userAuctionById->upazilaName}}, {{$userAuctionById->districtName}}, {{$userAuctionById->divisionName}}</th>
    </tr>
    <tr>
        <th>Auction Creation Date-Time</th>
        <th>{{$userAuctionById->created_at}}</th>
    </tr>
</table>

@endsection
