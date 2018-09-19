@extends('admin.master')

@section('title')
{{$user->name}}'s Auctions
@endsection

@section('content')

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
                <a href="{{url('admin/user-auction/show/'.$userAuction->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                <a href="{{url('admin/user-auction-delete/'.$userAuction->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$userAuctions->links()}}

@endsection
