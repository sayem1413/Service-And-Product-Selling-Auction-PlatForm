@extends('admin.master')

@section('title')
Add Color
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Add Color</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/color-update', 'method'=>'POST','class'=>'form-horizontal','name'=>'editColorForm'])!!}
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="hidden" value="{{$colorById->id}}" class="form-control" name="colorId">
                </div>
            </div>
            <div class="form-group">
                <label for="colorName" class="col-sm-2 control-label">Color Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="colorName" value="{{$colorById->colorName}}">
                    <span class="text-danger">{{$errors->has('colorName')?$errors->first('colorName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Publication Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name="publicationStatus">
                        <option value="2">Select Publication Status</option>
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                    </select>
                    <span class="text-danger">{{$errors->has('publicationStatus')?$errors->first('publicationStatus'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-block" name="">Update Color Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>

<script>
    document.forms['editColorForm'].elements['publicationStatus'].value = {{$colorById->publicationStatus}};
</script>

@endsection


