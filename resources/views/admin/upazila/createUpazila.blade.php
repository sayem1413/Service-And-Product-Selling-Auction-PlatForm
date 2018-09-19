@extends('admin.master')

@section('title')
Add Uazilla
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Add Uazilla</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/upazila-save', 'method'=>'POST','class'=>'form-horizontal' ])!!}
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">District Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name="district_id">
                        <option value="0">Select District Name</option>
                        @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->districtName}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{$errors->has('district_id')?$errors->first('district_id'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="upazilaName" class="col-sm-2 control-label">District Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="upazilaName">
                    <span class="text-danger">{{$errors->has('upazilaName')?$errors->first('upazilaName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-block" name="">Save Upazila Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>

@endsection


