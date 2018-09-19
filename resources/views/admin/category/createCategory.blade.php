@extends('admin.master')

@section('title')
Add Category
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Add Category</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/category-save', 'method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data' ])!!}
            <div class="form-group">
                <label for="categoryName" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="categoryName">
                    <span class="text-danger">{{$errors->has('categoryName')?$errors->first('categoryName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="categoryDescription" class="col-sm-2 control-label">Category Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="categoryDescription" rows="8"></textarea>
                    <span class="text-danger">{{$errors->has('categoryDescription')?$errors->first('categoryDescription'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Category Image</label>
                <div class="col-sm-10">
                    <input type="file" id="categoryImageInput" class="form-control" name="categoryImage">
                    <br/>
                    <span><img src="#" id="categoryImage" alt=""  height="200px" width="200px" ></span>
                    <span class="text-danger">{{$errors->has('categoryImage')?$errors->first('categoryImage'):''}}</span>
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
                    <button type="submit" class="btn btn-success btn-block" name="">Save Category Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>

<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#categoryImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#categoryImageInput").change(function () {
        readURL(this);
    });
</script>

@endsection
