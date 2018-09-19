@extends('admin.master')

@section('title')
Category Wise Sub-Categories
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Sub-Category ID</th>
            <th><strong>{{$category->categoryName}}</strong> has following Sub-Categories</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subCategories as $subCategory)
        <tr>
            <td scope="row">{{$subCategory->id}}</td>
            <td>{{$subCategory->subCategoryName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

