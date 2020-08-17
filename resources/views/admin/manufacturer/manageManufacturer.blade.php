@extends('admin.master')

@section('title')
Manage Manufacturers
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Manufacturer Name</th>
            <th>Publication Status</th>
            <!-- <th>Sub-Categories</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($manufacturers as $manufacturer)
        <tr>
            <td scope="row">{{$manufacturer->id}}</td>
            <td>{{$manufacturer->manufacturerName}}</td>
            <td>{{$manufacturer->publicationStatus == 1 ? 'Published':'Unpublished' }}</td>
            <!-- <td>
                <a href="{{url('admin/manufacturer/sub-categories/'.$manufacturer->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td> -->
            <td>
                <a href="{{url('admin/manufacturer-edit/'.$manufacturer->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/manufacturer-delete/'.$manufacturer->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$manufacturers->links()}}

@endsection