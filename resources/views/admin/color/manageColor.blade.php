@extends('admin.master')

@section('title')
Manage Colors
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Color Name</th>
            <th>Publication Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($colors as $color)
        <tr>
            <td scope="row">{{$color->id}}</td>
            <td>{{$color->colorName}}</td>
            <td>{{$color->publicationStatus == 1 ? 'Published':'Unpublished' }}</td>
            <td>
                <a href="{{url('admin/color-edit/'.$color->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/color-delete/'.$color->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$colors->links()}}

@endsection
