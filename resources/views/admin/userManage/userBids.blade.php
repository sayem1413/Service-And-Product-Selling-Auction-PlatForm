@extends('admin.master')

@section('title')
Manage User Bids
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
            <th>Auction Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userBids as $userBid)
        <tr>
            <td scope="row">{{$userBid->id}}</td>
            <td>{{$userBid->fee}}</td>
            <td>
                <a href="{{url('admin/user-auction/show/'.$userBid->auction_id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('/admin/delete-bid/'.$userBid->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this bid?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$userBids->links()}}
@endsection