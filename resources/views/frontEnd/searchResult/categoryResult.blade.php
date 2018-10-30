@extends('frontEnd.master')

@section('title')

search results

@endsection

@section('mainContent')

<div class="total-ads main-grid-border">
    <div class="container">
        <div class="select-box">
            {!! Form::open(['url'=>'/internal/search-result', 'method'=>'POST'])!!}
            {{ csrf_field() }}
                <div class="select-city-for-local-ads ads-list">
                    <label>Select your city to see local ads</label>
                    <div class="form-group">
                        <select class="form-control" name="divisions" id="divisions">
                            <option value="0">Select division</option>
                            @foreach($divisions as $division)
                            <option value="{{$division->id}}">{{$division->divisionName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="browse-category ads-list">
                    <label>Browse Categories</label>
                    <select class="form-control" name="categories" id="categories">
                        <option value="0">Select Your Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="search-product ads-list">
                    <label>Search for a specific Auction/product</label>
                    <div class="search">
                        <div id="custom-search-input">
                            <div class="input-group">
                                <input type="text" class="form-control input-lg" id="search" name="search" placeholder="Search keywords" />
                                <span id="result"></span>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            
            {!! Form::close()!!}
                <div class="clearfix"></div>
            
        </div>
<!--        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="index.html">Home</a></li>
            <li><a href="categories.html">Categories</a></li>
            <li class="active">Electronics & Appliances</li>
        </ol>-->
        <div class="ads-grid">
            <div class="side-bar col-md-3">
<!--                <div class="search-hotel">
                    <h3 class="sear-head">Name contains</h3>
                    <form>
                        <input type="text" value="Product name..." onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Product name...';
                                }" required="">
                        <input type="submit" value=" ">
                    </form>
                </div>

                <div class="range">
                    <h3 class="sear-head">Price range</h3>
                    <ul class="dropdown-menu6">
                        <li>

                            <div id="slider-range"></div>							
                            <input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
                        </li>			
                    </ul>
                    
                    
                    <script type='text/javascript'>//<![CDATA[ 
                            $(window).load(function () {
                                $("#slider-range").slider({
                                    range: true,
                                    min: 0,
                                    max: 9000,
                                    values: [50, 6000],
                                    slide: function (event, ui) {
                                        $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                                    }
                                });
                                $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

                            });//]]>  

                    </script>

                </div>-->
                {!! Form::open(['url'=>'/geo/search', 'method'=>'POST'])!!}
                <div class="brand-select">
                    <button type="button"  onClick="getLocation()" class="btn btn-block btn-info">Get GEO Location<i class="glyphicon glyphicon-filter"></i></button>
                </div>
                <div class="brand-select">
                    <h3 class="sear-head">Your GPS Location here</h3>
                    <input type="text" id="output" name="output" class="form-control" />
                    <span class="text text-danger" id="error"></span>
                </div>
                <div class="brand-select">
                     <button type="submit" class="btn btn-block btn-success">Find Ads near you <i class="glyphicon glyphicon-search"></i></button>
                </div>
                {!! Form::close()!!}
                
                {!! Form::open(['url'=>'/filter/search', 'method'=>'POST'])!!}
                <div class="brand-select">
                    <h3 class="sear-head">Price Range Max</h3>
                    <input type="number" id="amountMax" name="amountMax" class="form-control" />
                </div>
                <div class="brand-select">
                    <h3 class="sear-head">Price Range Min</h3>
                    <input type="number" id="amountMin" name="amountMin" class="form-control" />
                </div>
                <div class="brand-select">
                    <h3 class="sear-head">Auction date</h3>
                    <input type="date" id="date" name="date" class="form-control" />
                </div>
                <div class="brand-select">
                    <h3 class="sear-head">Sub-Categories</h3>
                    <select class="form-control"  name="subcategories" id="subcategories">
                        <option value="0" disable="true" selected="true">Sub-Categories</option>
                    </select>
                </div>
                <div class="brand-select">
                    <h3 class="sear-head">districts</h3>
                    <select class="form-control"  name="districts" id="districts">
                        <option value="0" disable="true" selected="true">districts</option>
                    </select>
                </div>
                <div class="brand-select">
                    <h3 class="sear-head">Upazilas or Thanas</h3>
                    <select class="form-control"  name="upazilas" id="upazilas">
                        <option value="0" disable="true" selected="true">Thana/upazilas</option>
                    </select>
                </div>
                <div class="brand-select">
                     <button type="submit" class="btn btn-block btn-success">Auctions Filter <i class="glyphicon glyphicon-filter"></i></button>
                </div>
                {!! Form::close()!!}
<!--                <div class="featured-ads">
                    <h2 class="sear-head fer">Featured Ads</h2>
                    <div class="featured-ad">
                        <a href="single.html">
                            <div class="featured-ad-left">
                                <img src="images/f1.jpg" title="ad image" alt="" />
                            </div>
                            <div class="featured-ad-right">
                                <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
                                <p>$ 450</p>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                    <div class="featured-ad">
                        <a href="single.html">
                            <div class="featured-ad-left">
                                <img src="images/f2.jpg" title="ad image" alt="" />
                            </div>
                            <div class="featured-ad-right">
                                <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
                                <p>$ 380</p>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                    <div class="featured-ad">
                        <a href="single.html">
                            <div class="featured-ad-left">
                                <img src="images/f3.jpg" title="ad image" alt="" />
                            </div>
                            <div class="featured-ad-right">
                                <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
                                <p>$ 560</p>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>-->
            </div>
            <div class="ads-display col-md-9">
                <div class="wrapper">					
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                    <span class="text">All Ads</span>
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div>
                                    <div id="container">
<!--                                        <div class="view-controls-list" id="viewcontrols">
                                            <label>view :</label>
                                            <a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>
                                        </div>
                                        <div class="sort">
                                            <div class="sort-by">
                                                <label>Sort By : </label>
                                                <select>
                                                    <option value="">Most recent</option>
                                                    <option value="">Price: Rs Low to High</option>
                                                    <option value="">Price: Rs High to Low</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>-->
                                        <ul class="list" id="results">
                                            @foreach($searchResults as $searchResult)
                                            <a href="{{url('/auction/details/'.$searchResult->id)}}">
                                                <li>
                                                    <img src="{{asset($searchResult->adImage1)}}" title="" alt="" height="135px" width="145px" />
                                                    <section class="list-left">
                                                        <h5 class="title">{{$searchResult->auctionTitle}}</h5>
                                                        <span class="adprice">&#x9f3 {{$searchResult->price}}/-</span>
                                                        <p class="catpath">{{$searchResult->categoryName}}>{{$searchResult->subCategoryName}}</p>
                                                    </section>
                                                    <section class="list-right">
                                                        <span class="date">{{$searchResult->created_at}}</span>
                                                        <span class="cityname">{{$searchResult->districtName}},{{$searchResult->divisionName}}</span>
                                                    </section>
                                                    <div class="clearfix"></div>
                                                </li> 
                                            </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{$searchResults->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>	
</div>
<script type="text/javascript">

  $( function() {
    $( "#search" ).autocomplete({
      source: 'http://localhost/www.resale.com/search'
    });
  } );
  
  </script>
  <script type="text/javascript">
  $(document).ready(function () {
        $('#categories').on('change', function (e) {
            console.log(e);
            var category_id = e.target.value;
            $.get("{{url('/subcategories')}}?category_id=" + category_id, function (data) {
                console.log(data);
                $('#subcategories').empty();
                $('#subcategories').append('<option value="0" disable="true" selected="true">Sub-Categories</option>');
                
                $.each(data, function (index, SubCategoryObj) {
                    $('#subcategories').append('<option value="' + SubCategoryObj.id + '">' + SubCategoryObj.subCategoryName + '</option>');
                });
            });
        });

        $('#divisions').on('change', function (e) {
            console.log(e);
            var division_id = e.target.value;
            $.get("{{url('/districts')}}?division_id=" + division_id, function (data) {
                console.log(data);
                $('#districts').empty();
                $('#districts').append('<option value="0" disable="true" selected="true">districts</option>');

                $.each(data, function (index, districtsObj) {
                    $('#districts').append('<option value="' + districtsObj.id + '">' + districtsObj.districtName + '</option>');
                });
            });
        });
        $('#districts').on('change', function (e) {
            console.log(e);
            var district_id = e.target.value;
            $.get("{{url('/upazilas')}}?district_id=" + district_id, function (data) {
                console.log(data);
                $('#upazilas').empty();
                $('#upazilas').append('<option value="0" disable="true" selected="true">Thana/upazilas</option>');

                $.each(data, function (index, UpazialsObj) {
                    $('#upazilas').append('<option value="' + UpazialsObj.id + '">' + UpazialsObj.upazilaName + '</option>');
                });
            });
        });
    });
</script>
<script type="text/javascript">
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
//				x.innerHTML += data.results[0].address_components[2].long_name+", ";
//				x.innerHTML += data.results[0].address_components[3].long_name+", ";
//				x.innerHTML += data.results[0].address_components[4].long_name+", ";
//				x.innerHTML += data.results[0].address_components[5].long_name;
            }
        });

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
  
</script>
@endsection

