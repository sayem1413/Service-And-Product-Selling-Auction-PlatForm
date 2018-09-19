@extends('admin.master')

@section('title')
Add Division
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Add Division</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/division-save', 'method'=>'POST','class'=>'form-horizontal'])!!}
            <div class="form-group">
                <label for="divisionName" class="col-sm-2 control-label">Division Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="divisionName">
                    <span class="text-danger">{{$errors->has('divisionName')?$errors->first('divisionName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="banglaName" class="col-sm-2 control-label">Bangla Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="banglaName">
                    <span class="text-danger">{{$errors->has('banglaName')?$errors->first('banglaName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-block" name="">Save Division Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>

@endsection