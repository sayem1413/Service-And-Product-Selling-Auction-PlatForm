@extends('frontEnd.master1')

@section('title')
Ad-Post
@endsection

@section('mainContent')

<hr/>

<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <h3 class="text-center"><u>Give Your Post Details here</u></h3>
        <h4 class="text-center text-success">{{Session::get('message')}}</h4>
        <hr/>
            {!! Form::open(['url'=>'/post-ad/post-ad-save', 'method'=>'POST', 'class'=>'form-horizontal','enctype'=>'multipart/form-data', 'id'=>'form-post-save' ])!!}
            {{ csrf_field() }}
            
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your GPS Location </label>
                </div>
                <div class="col-sm-8">
                    <input type="text" value="{{$gpsLocation}}" id="gpsLocation" class="form-control" name="gpsLocation">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Selected Category</label>
                </div>
                <div class="col-sm-8">
                    <input type="hidden" value="{{$category->id}}" id="category_id" name="category_id">
                    <input type="text" value="{{$category->categoryName}}" id="category" class="form-control" name="category" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Selected Sub-Category</label>
                </div>
                <div class="col-sm-8">
                    <input type="hidden" value="{{$subcategory->id}}" id="subcategory_id" name="subcategory_id">
                    <input type="text" value="{{$subcategory->subCategoryName}}" id="subcategory" class="form-control" name="subcategory" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Selected Division</label>
                </div>
                <div class="col-sm-8">
                    <input type="hidden" value="{{$division->id}}" id="division_id" name="division_id">
                    <input type="text" value="{{$division->divisionName}}" id="division" class="form-control" name="division" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Selected District</label>
                </div>
                <div class="col-sm-8">
                    <input type="hidden" value="{{$district->id}}" id="district_id" name="district_id">
                    <input type="text" value="{{$district->districtName}}" id="district" class="form-control" name="district" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Upazila or Thana</label>
                </div>
                <div class="col-sm-8">
                    <input type="hidden" value="{{$upazila->id}}" id="upazila_id" name="upazila_id">
                    <input type="text" value="{{$upazila->upazilaName}}" id="upazila" class="form-control" name="upazila" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3">
                    <label for="title">Your Ad Images</label>
                </div>
                <div class="col-sm-3">
                    <input type="file" id="adImageInput1" class="form-control" name="adImage1" >
                    <br/>
                    <span><img src="#" id="adImage1"  height="170px" width="150px" ></span>
                </div>
                <div class="col-sm-3">
                    <input type="file" id="adImageInput2" class="form-control" name="adImage2" >
                    <br/>
                    <span><img src="#" id="adImage2"  height="170px" width="150px" ></span>
                </div>
                <div class="col-sm-3">
                    <input type="file" id="adImageInput3" class="form-control" name="adImage3" >
                    <br/>
                    <span><img src="#" id="adImage3"  height="170px" width="150px" ></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Advertisement Title</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" placeholder="Product Title here" id="auctionTitle" class="form-control" name="auctionTitle" >
                    <span class="text-danger">{{$errors->has('auctionTitle')?$errors->first('auctionTitle'):''}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Product Condition</label>
                </div>
                <div class="col-sm-2">
                    <label><input type="radio" id="condition" name="condition" value="0">  New</label>
                </div>
                <div class="col-sm-2">
                    <label><input type="radio" id="condition" name="condition" value="1">  Used</label>
                </div>
                <div class="col-sm-4">
                    <span class="text-danger">{{$errors->has('condition')?$errors->first('condition'):''}}</span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Price</label>
                </div>
                <div class="col-sm-4">
                    <input type="number" name="price" id="price" class="form-control" >
                    <span class="text-danger">{{$errors->has('price')?$errors->first('price'):''}}</span>
                </div>
                <div class="col-sm-4">
                    <label><input type="checkbox" id="negotiable" name="negotiable" value="1">  Negotiable</label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Your Advertisement Description</label>
                </div>
                <div class="col-sm-8">
                    <textarea class="form-control" id="auctionDescription" name="auctionDescription" rows="14"></textarea>
                    <span class="text-danger">{{$errors->has('auctionDescription')?$errors->first('auctionDescription'):''}}</span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="title">Phone Number</label>
                </div>
                <div class="col-sm-4">
                    <input type="tel" pattern="(^([+]{1}[8]{2}|0088)?(01){1}[5-9]{1}\d{8})$" name="phoneNumber" id="phoneNumber" class="form-control" >
                    <span class="text-danger">{{$errors->has('phoneNumber')?$errors->first('phoneNumber'):''}}</span>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-1">
                    <label for="title">Name</label>
                </div>
                <div class="col-sm-5">
                    <label class="label-info">{{Auth::user()->name}}</label>
                </div>
                <div class="col-sm-1">
                    <label for="title">Email</label>
                </div>
                <div class="col-sm-5">
                    <label class="label-info">{{Auth::user()->email}}</label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-success btn-block" name="">Publish Your Advertisement or Auction Details</button>
                </div>
            </div>
            {!! Form::close()!!}
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#form-post-save").validate({
            errorClass: 'errorColor',
            rules:
            {
                'auctionTitle':
                {
                    required: true,
                },
                'auctionDescription':
                {
                    required: true,
                },
                'phoneNumber':
                {
                    required: true,
                },
                'condition':
                {
                    required: true,
                },
                'price':
                {
                    required: true,
                }
            },
            messages:
            {
                'auctionTitle':
                {
                    required: "Auction title is required!",
                },
                'auctionDescription':
                {
                    required: "Auction description is required!",
                },
                'phoneNumber':
                {
                    required: "phone number is required!",
                },
                'condition':
                {
                    required: "Condition selection is required!",
                },
                'price':
                {
                    required: "Auction price is required",
                }
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
<script>
    function readURL1(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adImage1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#adImageInput1").change(function () {
        readURL1(this);
    });

    function readURL2(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adImage2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#adImageInput2").change(function () {
        readURL2(this);
    });

    function readURL3(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#adImage3').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#adImageInput3").change(function () {
        readURL3(this);
    });

</script>

@endsection


