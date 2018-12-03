@extends('frontEnd.master1')

@section('title')
Select Category
@endsection

@section('mainContent')

<hr/>

<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <h3 class="text-center"><u>Select Post Category and Location</u></h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>
<!--        <br/>
        <div class="offset-3">
            <button class="btn btn-success" onClick="getLocation()">Click here to get your GPS Location</button>
        </div>-->

        <hr/>
        
            {!! Form::open(['url'=>'/post-ad/category-area-save', 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'form-select-area' ])!!}
            
            
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your GPS Location or you add your location Manually</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" id="output" class="form-control" name="gpsLocation">
                    <br/>
                    <span class="text-danger" id="error"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Select Category</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="categories" id="categories" >
                        <option value="" disable="true" selected="true"> Select Category </option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{ $category->categoryName }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{$errors->has('categories')?$errors->first('categories'):''}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Select Sub-Category</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="subcategories" id="subcategories" >
                        <option value="" disable="true" selected="true"> Select Sub-Category </option>
                    </select>
                    <span class="text-danger">{{$errors->has('subcategories')?$errors->first('subcategories'):''}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Division</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="divisions" id="divisions" >
                        <option value="" disable="true" selected="true"> Select Division </option>
                        @foreach ($divisions as $division)
                        <option value="{{$division->id}}">{{ $division->divisionName }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{$errors->has('divisions')?$errors->first('divisions'):''}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your District</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="districts" id="districts" >
                        <option value="" disable="true" selected="true"> Select District </option>
                    </select>
                    <span class="text-danger">{{$errors->has('districts')?$errors->first('districts'):''}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="">Your Upazila</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="upazilas" id="upazilas" >
                        <option value="" disable="true" selected="true"> Select Upazila </option>
                    </select>
                    <span class="text-danger">{{$errors->has('upazilas')?$errors->first('upazilas'):''}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success btn-block" name="">Your Ad Category and Location >>> click next</button>
                </div>
            </div>
            {!! Form::close()!!}
        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#form-select-area").validate({
            errorClass: 'errorColor',
            rules:
            {
//                'gpsLocation':
//                {
//                    required: true,
//                },
                'categories':
                {
                    required: true,
                },
                'subcategories':
                {
                    required: true,
                },
                'divisions':
                {
                    required: true,
                },
                'districts':
                {
                    required: true,
                },
                'upazilas':
                {
                    required: true,
                },
            },
            messages:
            {
//                'gpsLocation':
//                {
//                    required: "Jquery Working!",
//                },
                'categories':
                {
                    required: "Category selection is required!",
                },
                'subcategories':
                {
                    required: "Sub-Category selection is required!",
                },
                'divisions':
                {
                    required: "Division selection is required!",
                },
                'districts':
                {
                    required: "District selection is required!",
                },
                'upazilas':
                {
                    required: "Upazila or Thana selection is required!",
                },
            },
            highlight: function(element){
              $(element).parent().addClass('errorColor')  
            },
            unhighlight: function(element){
              $(element).parent().removeClass('errorColor')
            }
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#categories').on('change', function (e) {
            console.log(e);
            var category_id = e.target.value;
            $.get("{{url('/json-subcategories')}}?category_id=" + category_id, function (data) {
                console.log(data);
                $('#subcategories').empty();
                $('#subcategories').append('<option value="" disable="true" selected="true"> Select Sub-Category </option>');

                $.each(data, function (index, SubCategoryObj) {
                    $('#subcategories').append('<option value="' + SubCategoryObj.id + '">' + SubCategoryObj.subCategoryName + '</option>');
                });
            });
        });

        $('#divisions').on('change', function (e) {
            console.log(e);
            var division_id = e.target.value;
            $.get("{{url('/json-districts')}}?division_id=" + division_id, function (data) {
                console.log(data);
                $('#districts').empty();
                $('#districts').append('<option value="" disable="true" selected="true"> Select District </option>');

                $.each(data, function (index, districtsObj) {
                    $('#districts').append('<option value="' + districtsObj.id + '">' + districtsObj.districtName + '</option>');
                });
            });
        });
        $('#districts').on('change', function (e) {
            console.log(e);
            var district_id = e.target.value;
            $.get("{{url('/json-upazilas')}}?district_id=" + district_id, function (data) {
                console.log(data);
                $('#upazilas').empty();
                $('#upazilas').append('<option value="" disable="true" selected="true"> Select Upazila </option>');

                $.each(data, function (index, UpazialsObj) {
                    $('#upazilas').append('<option value="' + UpazialsObj.id + '">' + UpazialsObj.upazilaName + '</option>');
                });
            });
        });
    });

    getLocation();
    var x = document.getElementById('output');
    var y = document.getElementById('error');
    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else
        {
            y.innerHTML = "Your browser not supporting!";
        }
    }

    function showPosition(position)
    {
        // x.innerHTML = "latitude = "+position.coords.latitude;
        // x.innerHTML += "<br/>";
        // x.innerHTML += "longitude = "+position.coords.longitude;

        var locAPI = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&sensor=true";

        // x.innerHTML = locAPI;

        $.get({
            url: locAPI,
            success: function (data) {
                console.log(data);
                x.value = data.results[0].address_components[1].long_name;
//                x.innerHTML += data.results[0].address_components[2].long_name+", ";
//                x.innerHTML += data.results[0].address_components[3].long_name+", ";
//                x.innerHTML += data.results[0].address_components[4].long_name+", ";
//                x.innerHTML += data.results[0].address_components[5].long_name;
            }
        });

//        $.ajax({
//            type: 'post',
//            url: '?gps=1',
//            data: {
//                    lng: position.coords.longitude,
//                    lat: position.coords.latitude,
//                    tzoffset: (new Date).getTimezoneOffset()/-60,
//                    tzname: Intl.DateTimeFormat().resolvedOptions().timeZone,
//                    tzdst: is_dst(),
//                    time: time_str(),
//            },
//            error: function (request, status, error) {
//                    $('#output').html("Your GPS is ok. But network connection failed")
//            },
//            success: function (data) {
//                console.log(data);
//                x.value = data.results[0].address_components[1].long_name;
//            }
//        });

    }

    function showError(error)
    {
        switch (error.code)
        {
            case error.PERMISSION_DENIED :
                y.innerHTML = "Error 1 : " + error.code + "User dont want to share location!";
                break;

            case error.POSITION_UNAVAILABLE :
                y.innerHTML = "Error 2 : " + error.code + "location unavailable!";
                break;

            case error.TIMEOUT :
                y.innerHTML = "Error 3 : " + error.code + "request timed out!";
                break;

            case error.UNKNOWN_ERROR :
                y.innerHTML = "Error 4 : " + error.code + "Unknown error!";
                break;

        }
    }
    
//    function time_str(){
//	var d=new Date
//	return [d.getMonth()+1,
//	d.getDate(),
//	d.getFullYear()].join('-')+' '+
//	[d.getHours(),
//	d.getMinutes(),
//	d.getSeconds()].join(':');
//    }
//    function is_dst(){
//        var today=new Date()
//        var jan = new Date(today.getFullYear(), 0, 1);
//        var jul = new Date(today.getFullYear(), 6, 1);
//        return today.getTimezoneOffset() < Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset()) ? "DST" : ''
//    }

</script>
@endsection


