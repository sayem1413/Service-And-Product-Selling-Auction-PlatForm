<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Admin Register</title>
        <!-- Bootstrap core CSS-->
        <link href="{{asset('public/admin/blackAdmin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="{{asset('public/admin/blackAdmin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="{{asset('public/admin/blackAdmin/css/sb-admin.css')}}" rel="stylesheet">
        <link href="{{asset('public/admin/')}}/dist/css/style.css" rel="stylesheet">
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('public/admin/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('public/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('public/admin/')}}/js/jquery.validate.js"></script>
    </head>

    <body class="bg-dark">
        <div class="container">
            <div class="card card-register mx-auto mt-5">
                <div class="card-header">Register an Account</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.register') }}" aria-label="{{ __('Register') }}"  id="form_register">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus autocomplete="off">

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="off">

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center">
                        <a class="d-block small mt-3" href="{{ route('admin.login') }}">Login Page</a>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#form_register").validate({
            errorClass: 'errorColor',
            rules:
            {
                'name':
                {
                    required: true,
                    minlength: 3
                },
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
                'password_confirmation':
                {
                    equalTo: '#password'
                }
            },
            messages:
            {
                'name':
                {
                    required: "The name field is mandatory!",
                    minlength: "Please enter a name at least 3 characters!",
                },
                'email':
                {
                    required: "The Email is required!",
                    email: "Please enter a valid email address!",
                },

                'password':
                {
                    required: "The password field is mandatory!",
                    minlength: "Please enter a password at least 6 characters!",
                },
                'password_confirmation':
                {
                    equalTo: "passwords mismatch!",
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
