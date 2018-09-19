@extends('admin.master')

@section('title')
Manage Auctions
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Ad ID</th>
            <th>Auction Title</th>
            <th>Auction Description</th>
            <th>Condition</th>
            <th>Price</th>
            <th>Negotiable</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allAuctions as $allAuction)
        <tr>
            <td scope="row">{{$allAuction->id}}</td>
            <td>{{$allAuction->auctionTitle}}</td>
            <td>{{$allAuction->auctionDescription}}</td>
            <td>{{$allAuction->condition == 1 ? 'Used':'New' }}</td>
            <td>{{$allAuction->price}}</td>
            <td>{{$allAuction->negotiable == 1 ? 'Negotiable':'Fixed' }}</td>
            <td><img src="{{asset($allAuction->adImage1)}}" alt="adImage1" height="100px" width="100px">
                <br/><hr/><img src="{{asset($allAuction->adImage2)}}" alt="adImage2" height="100px" width="100px">
                <br/><hr/><img src="{{asset($allAuction->adImage3)}}" alt="adImage3" height="100px" width="100px">
            </td>
            <td>
                <a href="{{url('/admin/auction/show/'.$allAuction->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-info-sign"></span>
                </a>
                <a href="{{url('/admin/auction/delete/'.$allAuction->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$allAuctions->links()}}
@endsection
