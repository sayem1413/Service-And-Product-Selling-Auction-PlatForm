@extends('admin.master')

@section('title')
Edit District
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Edit District</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/district-update', 'name'=>'editDistrictForm', 'method'=>'POST','class'=>'form-horizontal' ])!!}
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="hidden" value="{{$districtById->id}}" class="form-control" name="districtId">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Division Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name="division_id">
                        <option value="0">Select Division Name</option>
                        @foreach($divisions as $division)
                        <option value="{{$division->id}}">{{$division->divisionName}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{$errors->has('division_id')?$errors->first('division_id'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="districtName" class="col-sm-2 control-label">District Name</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$districtById->districtName}}" class="form-control" name="districtName">
                    <span class="text-danger">{{$errors->has('districtName')?$errors->first('districtName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="banglaName" class="col-sm-2 control-label">Bangla Name</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$districtById->banglaName}}" class="form-control" name="banglaName">
                    <span class="text-danger">{{$errors->has('banglaName')?$errors->first('banglaName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="website" class="col-sm-2 control-label">Website</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$districtById->website}}" class="form-control" name="website">
                    <span class="text-danger">{{$errors->has('website')?$errors->first('website'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-block" name="">Update District Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>
<script>
    document.forms['editDistrictForm'].elements['division_id'].value = {{$districtById->division_id}};
</script>
@endsection

