@extends('admin.master')

@section('title')
Division Wise Districts
@endsection

@section('content')

<hr/>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Districts Id</th>
            <th><strong>{{$division->divisionName}}</strong> has following Districts</th>
        </tr>
    </thead>
    <tbody>
        @foreach($districts as $district)
        <tr>
            <td scope="row">{{$district->id}}</td>
            <td>{{$district->districtName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection



