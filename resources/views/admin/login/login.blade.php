<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Login</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('public/admin/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('public/admin/')}}/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('public/admin/')}}/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('public/admin/')}}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <link href="{{asset('public/admin/')}}/dist/css/style.css" rel="stylesheet">
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('public/admin/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('public/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('public/admin/')}}/js/jquery.validate.js"></script>
        
    </head>

    <body class="bg-dark" style="background-color: #343a40">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Admin Login </h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}" id="form_login">
							{{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                    {{Form::email('email', null,['class'=>'form-control','placeholder'=>'Enter your email', 'autocomplete' => 'off'])}}
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                    {{Form::password('password',['class'=>'form-control','placeholder'=>'Enter your Password'])}}
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="checkbox">
                                    <label>{{Form::checkbox('name','rememberMe')}}Remember Me </label>
                                </div>
                                <div class="form-group">
                                    {{Form::submit('Login',['class'=>'btn btn-success btn-block','name'=>'btn'])}}
                                </div>
                            </form>
                            <div class="text-center">
                                <!-- <a class="d-block small mt-3" href="{{ route('admin.register') }}">Register an Account</a> ||  -->
                                <a class="d-block small" href="{{ route('admin.password.request') }}">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('public/admin/')}}/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('public/admin/')}}/dist/js/sb-admin-2.js"></script>

        <script type="text/javascript">
    $(document).ready(function()
    {
        $("#form_login").validate({
            errorClass: 'errorColor',
            rules:
            {
                'email':
                {
                    required: true,
                    email: true,
                },

                'password':
                {
                    required: true,
                    minlength: 6
                },
            },
            messages:
            {
                'email':
                {
                    required: "The Email is required!",
                    email: "Please enter a valid email address!",
                },

                'password':
                {
                    required: "The password field is mandatory!",
                    minlength: "Please enter a password at least 6 characters!"
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
        
    </body>

</html>




<!--<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Admin Login</title>
                 Bootstrap core CSS
        <link href="{{asset('public/admin/blackAdmin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
                 MetisMenu CSS 
        <link href="{{asset('public/admin/')}}/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
                 Custom fonts for this template
        <link href="{{asset('public/admin/blackAdmin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
                 Custom styles for this template
        <link href="{{asset('public/admin/blackAdmin/css/sb-admin.css')}}" rel="stylesheet">
    </head>

    <body class="bg-dark">
        <div class="container">
            <div class="card card-login mx-auto mt-5">
                <div class="card-header">Admin Login</div>
                <div class="card-body">
                    {!!Form::open(['url'=>'/login','method'=>'POST'])!!}
                    <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }}">
                        <label>Email address</label>
                        {{Form::email('email', null,['class'=>'form-control','placeholder'=>'Enter your email'])}}
                        @if($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        <label>Password</label>
                        {{Form::password('password',['class'=>'form-control','placeholder'=>'Enter your Password'])}}
                        @if($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                {{Form::checkbox('name','rememberMe')}} Remember Password</label>
                        </div>
                    </div>
                    {{Form::submit('Login',['class'=>'btn btn-primary btn-block','name'=>'btn'])}}
                    {!!Form::close()!!}
                    <div class="text-center">
                        <a class="d-block small mt-3" href="{{ route('register') }}">Register an Account</a>
                        <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
        Bootstrap core JavaScript
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('public/admin/blackAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        Core plugin JavaScript
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
         Bootstrap Core JavaScript 
        <script src="{{asset('public/admin/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
         Metis Menu Plugin JavaScript 
        <script src="{{asset('public/admin/')}}/vendor/metisMenu/metisMenu.min.js"></script>
         Custom Theme JavaScript 
        <script src="{{asset('public/admin/')}}/dist/js/sb-admin-2.js"></script>
    </body>

</html>-->


