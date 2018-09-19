@extends('admin.master')

@section('title')
Manage Divisions
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Division Name</th>
            <th>Bangla Name</th>
            <th>Districts</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($divisions as $division)
        <tr>
            <td scope="row">{{$division->id}}</td>
            <td>{{$division->divisionName}}</td>
            <td>{{$division->banglaName}}</td>
            <td>
                <a href="{{url('admin/districts-list/'.$division->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/division-edit/'.$division->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/division-delete/'.$division->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection