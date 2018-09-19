@extends('admin.master')

@section('title')
Manage Upazila
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>District Name</th>
            <th>Upazila Name</th>
            <th>Upazila bangla Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($upazilas as $upazila)
        <tr>
            <td scope="row">{{$upazila->id}}</td>
            <td>{{$upazila->districtName}}</td>
            <td>{{$upazila->upazilaName}}</td>
            <td>{{$upazila->banglaName}}</td>
            <td>
                <a href="{{url('admin/upazila-edit/'.$upazila->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/upazila-delete/'.$upazila->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$upazilas->links()}}


@endsection
