@extends('admin.master')

@section('title')
Manage Sub-Category
@endsection

@section('content')

<hr/>
<h4 class="text-center text-success">{{Session::get('message')}}</h4>
<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sub-Category Name</th>
            <th>Manufacturer Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subCategoryManfacturers as $subCategoryManfacturer)
        <tr>
            <td scope="row">{{$subCategoryManfacturer->id}}</td>
            <td>{{$subCategoryManfacturer->subCategoryName}}</td>
            <td>{{$subCategoryManfacturer->manufacturerName}}</td>
            <td>
                <a href="{{url('admin/subcategorymanufacturer-edit/'.$subCategoryManfacturer->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/subcategorymanufacturer-delete/'.$subCategoryManfacturer->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$subCategoryManfacturers->links()}}

@endsection

