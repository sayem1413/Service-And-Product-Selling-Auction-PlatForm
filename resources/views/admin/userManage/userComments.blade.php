@extends('admin.master')

@section('title')
Manage User Comments
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
            <th>Auction Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userComments as $userComment)
        <tr>
            <td scope="row">{{$userComment->id}}</td>
            <td>{{$userComment->commentBody}}</td>
            <td>
                <a href="{{url('admin/user-auction/show/'.$userComment->auction_id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('/admin/delete-comment/'.$userComment->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this comment?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$userComments->links()}}
@endsection

