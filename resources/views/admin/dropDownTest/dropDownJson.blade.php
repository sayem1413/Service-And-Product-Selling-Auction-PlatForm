@extends('admin.master')

@section('title')
Drop down JSON
@endsection

@section('content')
<hr/>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center">Drop down JSON Test</h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

        <hr/>
        <div class="well">
            {!! Form::open(['class'=>'form-horizontal' ])!!}
            <div class="form-group">
                <label for="title">Select Category</label>
                <select class="form-control" name="categories" id="categories">
                    <option value="0" disable="true" selected="true">=== Select Category ===</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{ $category->categoryName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Select Sub-Category</label>
                <select class="form-control" name="subcategories" id="subcategories">
                    <option value="0" disable="true" selected="true">=== Select Sub-Category ===</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Your Division</label>
                <select class="form-control" name="divisions" id="divisions">
                    <option value="0" disable="true" selected="true">=== Select Division ===</option>
                    @foreach ($divisions as $division)
                    <option value="{{$division->id}}">{{ $division->divisionName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Your District</label>
                <select class="form-control" name="districts" id="districts">
                    <option value="0" disable="true" selected="true">=== Select District ===</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Your Upazila</label>
                <select class="form-control" name="upazilas" id="upazilas">
                    <option value="0" disable="true" selected="true">=== Select Upazila ===</option>
                </select>
            </div> 
            {!! Form::close()!!}
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#divisions').on('change', function (e) {
            console.log(e);
            var division_id = e.target.value;
            $.get("{{url('admin/json-districts')}}?division_id=" + division_id, function (data) {
                console.log(data);
                $('#districts').empty();
                $('#districts').append('<option value="0" disable="true" selected="true">=== Select District ===</option>');

                $.each(data, function (index, districtsObj) {
                    $('#districts').append('<option value="' + districtsObj.id + '">' + districtsObj.districtName + '</option>');
                });
            });
        });
        $('#districts').on('change', function (e) {
            console.log(e);
            var district_id = e.target.value;
            $.get("{{url('admin/json-upazilas')}}?district_id=" + district_id, function (data) {
                console.log(data);
                $('#upazilas').empty();
                $('#upazilas').append('<option value="0" disable="true" selected="true">=== Select Upazila ===</option>');

                $.each(data, function (index, UpazialsObj) {
                    $('#upazilas').append('<option value="' + UpazialsObj.id + '">' + UpazialsObj.upazilaName + '</option>');
                });
            });
        });
        
        $('#categories').on('change', function (e) {
            console.log(e);
            var category_id = e.target.value;
            $.get("{{url('admin/json-subcategories')}}?category_id=" + category_id, function (data) {
                console.log(data);
                $('#subcategories').empty();
                $('#subcategories').append('<option value="0" disable="true" selected="true">=== Select Sub-Category ===</option>');

                $.each(data, function (index, SubCategoryObj) {
                    $('#subcategories').append('<option value="' + SubCategoryObj.id + '">' + SubCategoryObj.subCategoryName + '</option>');
                });
            });
        });
        
    });

</script>

@endsection


