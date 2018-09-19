@extends('admin.master')

@section('title')
Sub-Category Wise Manufacturers
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Manufacturer ID</th>
            <th><strong>{{$subCategoryName->subCategoryName}}</strong> has following Manufacturers</th>
        </tr>
    </thead>
    <tbody>
        @foreach($manfacturers as $manfacturer)
        <tr>
            <td scope="row">{{$manfacturer->id}}</td>
            <td>{{$manfacturer->manufacturerName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$manfacturers->links()}}

@endsection



