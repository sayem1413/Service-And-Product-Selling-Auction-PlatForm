@extends('admin.master')

@section('title')
Manage Auction Bids
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Bidding Price</th>
            <th>Bidder Profile</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auctionBids as $auctionBid)
        <tr>
            <td scope="row">{{$auctionBid->id}}</td>
            <td>{{$auctionBid->fee}}</td>
            <td>
                <a href="{{url('admin/user-details/'.$auctionBid->user_id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('/admin/auction/delete-bid/'.$auctionBid->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this bid?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$auctionBids->links()}}
@endsection
