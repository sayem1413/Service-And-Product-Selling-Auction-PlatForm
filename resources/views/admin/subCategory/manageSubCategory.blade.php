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
            <th>Category Type</th>
            <th>Publication Status</th>
            <th>Manufacturers</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subCategories as $subCategory)
        <tr>
            <td scope="row">{{$subCategory->id}}</td>
            <td>{{$subCategory->subCategoryName}}</td>
            <td>{{$subCategory->categoryName}}</td>
            <td>{{$subCategory->publicationStatus == 1 ? 'Published':'Unpublished' }}</td>
            <td>
                <a href="{{url('admin/manufactures/'.$subCategory->id)}}" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
            </td>
            <td>
                <a href="{{url('admin/sub-category-edit/'.$subCategory->id)}}" class="btn btn-success">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="{{url('admin/sub-category-delete/'.$subCategory->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$subCategories->links()}}

@endsection
