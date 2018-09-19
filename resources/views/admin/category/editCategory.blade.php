@extends('admin.master')

@section('title')
Edit Category
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Edit Category</h3>
        <!-- <h4 class="text-center text-success">{{Session::get('message')}}</h4> -->

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/category-update', 'method'=>'POST','class'=>'form-horizontal','name'=>'editCategoryForm','enctype'=>'multipart/form-data' ])!!}
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="hidden" value="{{$categoryById->id}}" class="form-control" name="categoryId">
                </div>
            </div>
            <div class="form-group">
                <label for="categoryName" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$categoryById->categoryName}}" class="form-control" name="categoryName">
                </div>
            </div>
            <div class="form-group">
                <label for="categoryDescription" class="col-sm-2 control-label">Category Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="categoryDescription" rows="8">{{$categoryById->categoryDescription}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Category Image</label>
                <div class="col-sm-10">
                    <input type="file" id="categoryImageInput" class="form-control" name="categoryImage" >
                    <br/>
                    <img src="{{asset($categoryById->categoryImage)}}" id="categoryImage" alt="" height="200px" width="200px">
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
                    <button type="submit" class="btn btn-success btn-block" name="">Upadte Category Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>

<script>
    document.forms['editCategoryForm'].elements['publicationStatus'].value = {{$categoryById->publicationStatus}};
    
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


