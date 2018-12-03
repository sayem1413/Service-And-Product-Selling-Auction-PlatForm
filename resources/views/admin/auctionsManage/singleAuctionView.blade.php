@extends('admin.master')

@section('title')
Single Auctions
@endsection

@section('content')

<hr/>
<hr/>

<table class="table table-hover table-bordered">
    <tr>
        <th>Auction Id</th>
        <th>{{$auctionViewById->id}}</th>
    </tr>
    <tr>
        <th>Auction Title</th>
        <th>{{$auctionViewById->auctionTitle}}</th>
    </tr>
    <tr>
        <th>Auction features</th>
        <th>{{$auctionViewById->auctionDescription}}</th>
    </tr>
    <tr>
        <th>Negotiable</th>
        <th>{{$auctionViewById->condition == 1 ? 'Used':'New' }}</th>
    </tr>
    <tr>
        <th>Auction price</th>
        <th>{{$auctionViewById->price}}</th>
    </tr>
    <tr>
        <th>Negotiable</th>
        <th>{{$auctionViewById->negotiable == 1 ? 'Negotiable':'Fixed' }}</th>
    </tr>
    <tr>
        <th>Auction Image1</th>
        <th><img src="{{asset($auctionViewById->adImage1)}}" id="adImage1"  height="170px" width="150px" ></th>
    </tr>
    <tr>
        <th>Auction Image2</th>
        <th><img src="{{asset($auctionViewById->adImage2)}}" id="adImage2"  height="170px" width="150px" ></th>
    </tr>
    <tr>
        <th>Auction Image3</th>
        <th><img src="{{asset($auctionViewById->adImage3)}}" id="adImage3"  height="170px" width="150px" ></th>
    </tr>
    <tr>
        <th>Auction Category</th>
        <th>{{$auctionViewById->categoryName}}</th>
    </tr>
    <tr>
        <th>Auction Sub-Category</th>
        <th>{{$auctionViewById->subCategoryName}}</th>
    </tr>
    <tr>
        <th>Auction Division</th>
        <th>{{$auctionViewById->divisionName}}</th>
    </tr>
    <tr>
        <th>Auction District</th>
        <th>{{$auctionViewById->districtName}}</th>
    </tr>
    <tr>
        <th>Auction Upazila</th>
        <th>{{$auctionViewById->upazilaName}}</th>
    </tr>
    <tr>
        <th>Auction GPS Location</th>
        <th>{{$auctionViewById->gpsLocation}}</th>
    </tr>
    <tr>
        <th>User Id</th>
        <th>{{$auctionViewById->user_id}}</th>
    </tr>
    <tr>
        <th>Auction End Time</th>
        <th>{{$auctionViewById->auctionExpiryDate}}</th>
    </tr>
    <tr>
        <th>Auctioneer Name</th>
        <th>{{$auctionViewById->name}}</th>
    </tr>
    <tr>
        <th>Auctioneer Email</th>
        <th>{{$auctionViewById->email}}</th>
    </tr>
    <tr>
        <th>Auctioneer phone Number</th>
        <th>{{$auctionViewById->phoneNumber}}</th>
    </tr>

</table>

@endsection

