@extends('admin.master')

@section('title')
Manage Auction Comments
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Comment Details</th>
            <th>Commented User Profile</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auctionComments as $auctionComment)
        <tr>
            <td scope="row">{{$auctionComment->id}}</td>
            <td>{{$auctionComment->commentBody}}</td>
            <td>
                <a href="{{url('admin/user-details/'.$auctionComment->user_id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('/admin/auction/delete-comment/'.$auctionComment->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this comment?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$auctionComments->links()}}
@endsection

