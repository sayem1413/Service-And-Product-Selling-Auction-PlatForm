@extends('admin.master')

@section('title')
Edit Sub-Category-Manufacturer
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Edit Sub-Category wise Manufacturer</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['url'=>'admin/subcategorymanufacturer-update','name'=>'editSubCategoryManufacturerForm', 'method'=>'POST','class'=>'form-horizontal' ])!!}
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="hidden" value="{{$subCategoryManufacturerById->id}}" class="form-control" name="subCategoryManufacturerId">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Sub-Category Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name="subcategory_id">
                        <option value="0">Select Sub-Category Name</option>
                        @foreach($subCategories as $subCategory)
                        <option value="{{$subCategory->id}}">{{$subCategory->subCategoryName}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{$errors->has('subcategory_id')?$errors->first('subcategory_id'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Manufacturer Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name="manufacturer_id">
                        <option value="0">Select Manufacturer Name</option>
                        @foreach($manufacturers as $manufacturer)
                        <option value="{{$manufacturer->id}}">{{$manufacturer->manufacturerName}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{$errors->has('manufacturer_id')?$errors->first('manufacturer_id'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-block" name="">Save Sub-Category Wise Manufacturer Info</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>

<script>
    document.forms['editSubCategoryManufacturerForm'].elements['subcategory_id'].value = {{$subCategoryManufacturerById->subcategory_id}};
    document.forms['editSubCategoryManufacturerForm'].elements['manufacturer_id'].value = {{$subCategoryManufacturerById->manufacturer_id}};
</script>

@endsection