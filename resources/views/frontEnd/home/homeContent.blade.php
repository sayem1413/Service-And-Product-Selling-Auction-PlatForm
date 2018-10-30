@extends('frontEnd.master')

@section('title')
Home
@endsection

@section('mainContent')
<!--<br/>
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-5">
        </div>
        <div class="col-md-7">
            <button class="btn btn-google-plus" onClick="getLocation()">Your GPS Location</button>
            <label id="output"></label>
        </div>

    </div>
</div>-->
<div class="content">
    
    <div class="trending-ads">
        <div class="container">
            <!-- slider -->
            <div class="trend-ads">
                <h2>Trending Ads</h2>
                <ul id="flexiselDemo3">
                    <li>
                        @if(count($sliderMobiles) > 1)
                        @foreach($sliderMobiles as $sliderMobile)
                        <div class="col-md-3 biseller-column">
                            <a href="{{url('/auction/details/'.$sliderMobile->id)}}">
                                <img src="{{asset($sliderMobile->adImage1)}}"/>
                                <span class="price">&#x9f3 {{$sliderMobile->price}}/-</span>
                            </a> 
                            <div class="ad-info">
                                <h5>{{$sliderMobile->auctionTitle}}</h5>
                                <span>{{$sliderMobile->created_at}}</span>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p1.jpg')}}"/>
                                <span class="price">&#36; 450</span>
                            </a> 
                            <div class="ad-info">
                                <h5>There are many variations of passages</h5>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p2.jpg')}}"/>
                                <span class="price">&#36; 399</span>
                            </a> 
                            <div class="ad-info">
                                <h5>Lorem Ipsum is simply dummy</h5>
                                <span>3 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p3.jpg')}}"/>
                                <span class="price">&#36; 199</span>
                            </a> 
                            <div class="ad-info">
                                <h5>It is a long established fact that a reader</h5>
                                <span>8 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p4.jpg')}}"/>
                                <span class="price">&#36; 159</span>
                            </a> 
                            <div class="ad-info">
                                <h5>passage of Lorem Ipsum you need to be</h5>
                                <span>19 hour ago</span>
                            </div>
                        </div>
                        @endif
                    </li>
                    <li>
                        @if(count($sliderLaptops) > 1)
                        @foreach($sliderLaptops as $sliderLaptop)
                        <div class="col-md-3 biseller-column">
                            <a href="{{url('/auction/details/'.$sliderLaptop->id)}}">
                                <img src="{{asset($sliderLaptop->adImage1)}}"/>
                                <span class="price">&#x9f3 {{$sliderLaptop->price}}/-</span>
                            </a> 
                            <div class="ad-info">
                                <h5>{{$sliderLaptop->auctionTitle}}</h5>
                                <span>{{$sliderLaptop->created_at}}</span>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p5.jpg')}}"/>
                                <span class="price">&#36; 1599</span>
                            </a> 
                            <div class="ad-info">
                                <h5>There are many variations of passages</h5>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p6.jpg')}}"/>
                                <span class="price">&#36; 1099</span>
                            </a> 
                            <div class="ad-info">
                                <h5>passage of Lorem Ipsum you need to be</h5>
                                <span>1 day ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p7.jpg')}}"/>
                                <span class="price">&#36; 109</span>
                            </a> 
                            <div class="ad-info">
                                <h5>It is a long established fact that a reader</h5>
                                <span>9 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p8.jpg')}}"/>
                                <span class="price">&#36; 189</span>
                            </a> 
                            <div class="ad-info">
                                <h5>Lorem Ipsum is simply dummy</h5>
                                <span>3 hour ago</span>
                            </div>
                        </div>
                        @endif
                    </li>
                    <li>
                        @if(count($sliderBikes) > 1)
                        @foreach($sliderBikes as $sliderBike)
                        <div class="col-md-3 biseller-column">
                            <a href="{{url('/auction/details/'.$sliderBike->id)}}">
                                <img src="{{asset($sliderBike->adImage1)}}"/>
                                <span class="price">&#x9f3 {{$sliderBike->price}}/-</span>
                            </a> 
                            <div class="ad-info">
                                <h5>{{$sliderBike->auctionTitle}}</h5>
                                <span>{{$sliderBike->created_at}}</span>
                            </div>
                        </div>
                        @endforeach
                        @elseif(count($sliderCars) > 1)
                        @foreach($sliderCars as $sliderCar)
                        <div class="col-md-3 biseller-column">
                            <a href="{{url('/auction/details/'.$sliderCar->id)}}">
                                <img src="{{asset($sliderCar->adImage1)}}"/>
                                <span class="price">&#x9f3 {{$sliderCar->price}}/-</span>
                            </a> 
                            <div class="ad-info">
                                <h5>{{$sliderCar->auctionTitle}}</h5>
                                <span>{{$sliderCar->created_at}}</span>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p9.jpg')}}"/>
                                <span class="price">&#36; 2599</span>
                            </a> 
                            <div class="ad-info">
                                <h5>Lorem Ipsum is simply dummy</h5>
                                <span>3 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p10.jpg')}}"/>
                                <span class="price">&#36; 3999</span>
                            </a> 
                            <div class="ad-info">
                                <h5>It is a long established fact that a reader</h5>
                                <span>9 hour ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p11.jpg')}}"/>
                                <span class="price">&#36; 2699</span>
                            </a> 
                            <div class="ad-info">
                                <h5>passage of Lorem Ipsum you need to be</h5>
                                <span>1 day ago</span>
                            </div>
                        </div>
                        <div class="col-md-3 biseller-column">
                            <a href="#">
                                <img src="{{asset('public/frontEnd/images/p12.jpg')}}"/>
                                <span class="price">&#36; 899</span>
                            </a> 
                            <div class="ad-info">
                                <h5>There are many variations of passages</h5>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        @endif
                    </li>
                </ul>
                
                <script type="text/javascript">
                    $(window).load(function () {
                        $("#flexiselDemo3").flexisel({
                            visibleItems: 1,
                            animationSpeed: 1000,
                            autoPlay: true,
                            autoPlaySpeed: 5000,
                            pauseOnHover: true,
                            enableResponsiveBreakpoints: true,
                            responsiveBreakpoints: {
                                portrait: {
                                    changePoint: 480,
                                    visibleItems: 1
                                },
                                landscape: {
                                    changePoint: 640,
                                    visibleItems: 1
                                },
                                tablet: {
                                    changePoint: 768,
                                    visibleItems: 1
                                }
                            }
                        });

                    });
                </script>
            </div>   
        </div>
        <!-- //slider -->	
        <script type="text/javascript" src="{{asset('public/frontEnd/js/jquery.flexisel.js')}}"></script>
    </div>
    <div class="categories">
        <div class="container">

            @foreach($categories as $category)
            <div class="col-md-2 focus-grid">
                <a href="{{url('/category/search/'.$category->id)}}">
                    <div class="focus-border">
                        <div class="focus-layout">
                            <div class="focus-image"><img src="{{asset($category->categoryImage)}}" alt="" height="90px" width="90px"></div>
                            <h4 class="clrchg">{{$category->categoryName}}</h4>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            <div class="clearfix"></div>
        </div>
    </div>
<!--    <div class="mobile-app">
        <div class="container">
            <div class="col-md-5 app-left">
                <a href="mobileapp.html"><img src="{{asset('public/frontEnd/images/app.png')}}" alt=""></a>
            </div>
            <div class="col-md-7 app-right">
                <h3>Resale App is the <span>Easiest</span> way for Selling and buying second-hand goods</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam auctor Sed bibendum varius euismod. Integer eget turpis sit amet lorem rutrum ullamcorper sed sed dui. vestibulum odio at elementum. Suspendisse et condimentum nibh.</p>
                <div class="app-buttons">
                    <div class="app-button">
                        <a href="#"><img src="{{asset('public/frontEnd/images/1.png')}}" alt=""></a>
                    </div>
                    <div class="app-button">
                        <a href="#"><img src="{{asset('public/frontEnd/images/2.png')}}" alt=""></a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>-->
</div>
<!--<script>
                    var x = document.getElementById('output');
                    function getLocation()
                    {
                        if (navigator.geolocation)
                        {
                            navigator.geolocation.getCurrentPosition(showPosition, showError);
                        } else
                        {
                            x.innerHTML = "Your browser not supporting!";
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
                                x.innerHTML = data.results[0].address_components[1].long_name;
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
                                x.innerHTML = "Error 1 : " + error.code + "User dont want to share location!";
                                break;

                            case error.POSITION_UNAVAILABLE :
                                x.innerHTML = "Error 2 : " + error.code + "location unavailable!";
                                break;

                            case error.TIMEOUT :
                                x.innerHTML = "Error 3 : " + error.code + "request timed out!";
                                break;

                            case error.UNKNOWN_ERROR :
                                x.innerHTML = "Error 4 : " + error.code + "Unknown error!";
                                break;

                        }
                    }

</script>-->

@endsection
