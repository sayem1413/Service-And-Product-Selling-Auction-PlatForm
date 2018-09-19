@extends('admin.master')

@section('title')
Manage Districts
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Disvision Name</th>
            <th>District Name</th>
            <th>District bangla Name</th>
            <th>Upazilas</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($districts as $district)
        <tr>
            <td scope="row">{{$district->id}}</td>
            <td>{{$district->divisionName}}</td>
            <td>{{$district->districtName}}</td>
            <td>{{$district->banglaName}}</td>
            <td>
                <a href="{{url('admin/upazilas-list/'.$district->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/district-edit/'.$district->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/district-delete/'.$district->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$districts->links()}}


@endsection
