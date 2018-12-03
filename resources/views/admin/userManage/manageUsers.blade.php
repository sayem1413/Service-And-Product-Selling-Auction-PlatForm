@extends('admin.master')

@section('title')
Manage App Users
@endsection

@section('content')

<hr/>
<div class="row">
    <div class="col-md-2">
        {!! Form::open(['url'=>'/admin/user-id/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <div class="input-group">
                    <input type="number" id="userId" max="" name="userId" style="width: 100px;">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
    </div>
    <div class="col-md-5">
        {!! Form::open(['url'=>'/admin/email-search/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <div class="input-group">
                    <input type="search" class="form-control" id="searchUserEmail" name="searchUserEmail" placeholder="Search email">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
        <script type="text/javascript">
            $( function() {
              $( "#searchUserEmail" ).autocomplete({
                source: 'http://localhost/www.resale.com/search-email'
              });
            } );
        </script>
    </div>
    <div class="col-md-5">
        {!! Form::open(['url'=>'/admin/name-search/', 'method'=>'POST', 'class'=>'form-inline'])!!}
        {{ csrf_field() }}
            <form class="form-inline" style="float: right;">
                <div class="input-group">
                    <input type="search" class="form-control" id="searchUserName" name="searchUserName" placeholder="Search name">
                </div>
                <button type="submit" class="btn btn-circle btn-success"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        {!! Form::close()!!}
        <script type="text/javascript">
            $( function() {
              $( "#searchUserName" ).autocomplete({
                source: 'http://localhost/www.resale.com/search-name'
              });
            } );
        </script>
    </div>
</div>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Details</th>
            <th>User Auctions</th>
            <th>User Comments</th>
            <th>User Bids</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td scope="row">{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a href="{{url('admin/user-details/'.$user->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/user-auctions/'.$user->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/user-comments/'.$user->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/user-bids/'.$user->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('/admin/delete-user/'.$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this user? If you delete this user, the all auctions of this user will be deleted!')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$users->links()}}
@endsection



