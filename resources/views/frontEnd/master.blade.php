<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/css/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/bootstrap-select.css')}}">
        <link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/flexslider.css')}}" type="text/css" media="screen" />
        <link rel="stylesheet" href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontEnd/css/easy-responsive-tabs.css')}}" />
        <link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href="{{asset('public/frontEnd/css/jquery.uls.css')}}" rel="stylesheet"/>
        <link href="{{asset('public/frontEnd/css/jquery.uls.grid.css')}}" rel="stylesheet"/>
        <link href="{{asset('public/frontEnd/css/jquery.uls.lcd.css')}}" rel="stylesheet"/>
        <!-- for-mobile-apps -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <!-- Scripts -->
        <!--fonts-->
        <!--//fonts-->	
        <!-- js -->
<!--        <script type="text/javascript" src="{{asset('public/js/jquery-3.3.1.js')}}"></script>-->
        <script type="text/javascript" src="{{asset('public/frontEnd/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/js/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/frontEnd/js/jquery.validate.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/js/bootstrap3-typeahead.min.js')}}"></script>
        <!-- js -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{asset('public/frontEnd/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/frontEnd/js/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/frontEnd/js/jquery.leanModal.min.js')}}"></script>
        <!-- Source -->
        <script src="{{asset('public/frontEnd/js/jquery.uls.data.js')}}"></script>
        <script src="{{asset('public/frontEnd/js/jquery.uls.data.utils.js')}}"></script>
        <script src="{{asset('public/frontEnd/js/jquery.uls.lcd.js')}}"></script>
        <script src="{{asset('public/frontEnd/js/jquery.uls.languagefilter.js')}}"></script>
        <script src="{{asset('public/frontEnd/js/jquery.uls.regionfilter.js')}}"></script>
        <script src="{{asset('public/frontEnd/js/jquery.uls.core.js')}}"></script>
        <script>
$(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
        mySelect.find('option:selected').prop('disabled', true);
        mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
        mySelect.find('option:disabled').prop('disabled', false);
        mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
});
        </script>
        
        <script>
$(document).ready(function () {
    $('.uls-trigger').uls({
        onSelect: function (language) {
            var languageName = $.uls.data.getAutonym(language);
            $('.uls-trigger').text(languageName);
        },
        quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
    });
});
        </script>
        

    </head>
    <body>
        <!-- header -->
        <!-- //header -->
        @include('frontEnd.includes.header')
        <!-- header-bot -->
        <!-- //header-bot -->
        <!-- banner -->
        @include('frontEnd.includes.banner')
        <!-- banner -->
        <!-- content-starts-here -->
        @yield('mainContent')
        <!--footer section start-->		
        @include('frontEnd.includes.footer')
        <!--footer section end-->
    </body>
</html>