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
                <div class="card-header">Admin Reset Password</div>
                <div class="card-body">
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}" id="form_email">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus autocomplete="off">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{asset('public/admin/blackAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('public/admin/blackAdmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#form_email").validate({
            errorClass: 'errorColor',
            rules:
            {
                'email':
                {
                    required: true,
                    email: true,
                },
            },
            messages:
            {
                'email':
                {
                    required: "The Email is required!",
                    email: "Please enter a valid email address!",
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
    </body>

</html>


