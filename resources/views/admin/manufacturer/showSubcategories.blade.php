@extends('admin.master')

@section('title')
Manufacturer Wise Sub-Categories
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Sub-Categories ID</th>
            <th><strong>{{$manufacturerName->manufacturerName}}</strong> has following Sub-Categories</th>
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

{{$subCategories->links()}}

@endsection
