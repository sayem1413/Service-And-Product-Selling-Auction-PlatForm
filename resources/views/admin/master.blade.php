<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('public/admin/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('public/admin/')}}/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('public/admin/')}}/dist/css/sb-admin-2.css" rel="stylesheet">
        
        <link href="{{asset('public/admin/')}}/dist/css/style.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{asset('public/admin/')}}/vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('public/admin/')}}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery/jquery.min.js')}}"></script>
        
        <script src="{{asset('public/admin/')}}/vendor/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('public/admin/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
        
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script src="{{asset('public/admin/')}}/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{asset('public/admin/')}}/vendor/raphael/raphael.min.js"></script>
        <script src="{{asset('public/admin/')}}/vendor/morrisjs/morris.min.js"></script>
        <script src="{{asset('public/admin/')}}/data/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('public/admin/')}}/dist/js/sb-admin-2.js"></script>
        
        <script>tinymce.init({selector: 'textarea'});</script>
        <script type="text/javascript" src="{{asset('public/js/jquery-ui.min.js')}}"></script>
        <!-- Bootstrap core JavaScript-->
        
        <script src="{{asset('public/admin/blackAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <script src="{{asset('public/admin/')}}/js/jquery.validate.js"></script>
        
        
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <!-- /.navbar-top-links -->
                @include('admin.includes.header')
                <div class="navbar-default sidebar" role="navigation">
                    @include('admin.includes.menu')
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                @yield('content')
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        
        
        
        

        <!-- Metis Menu Plugin JavaScript -->
        

    </body>

</html>


