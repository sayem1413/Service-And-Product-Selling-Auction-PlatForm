@extends('admin.master')

@section('title')
District Wise Upazilas
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Upazilas Id</th>
            <th><strong>{{$district->districtName}}</strong> has following Upazilas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($upazilas as $upazila)
        <tr>
            <td scope="row">{{$upazila->id}}</td>
            <td>{{$upazila->upazilaName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection



