@extends('frontEnd.master1')

@section('title')
Register
@endsection

@section('mainContent')


<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <div class="sign-up">
            <h1>Create an account</h1>
            <p class="creating">Having hands on experience in creating innovative designs,I do offer design 
                solutions which harness.</p>
            <h2>Personal Information</h2>
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" id="form_register">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autocomplete="off" autofocus required>

                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
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
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
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
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
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
                    <div class="col-md-4">
                        <strong>Already have an account? Go Back to <a href="{{ route('login') }}" class="links">Login</a></strong>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block">
                            Register
                        </button>
                    </div>
                </div>
            </form>
            <div class="sub_home">
                <div class="sub_home_right">
                    <p>Go Back to <a href="{{url('/home')}}">Home</a></p>
                </div>
                <div class="clearfix"> </div>
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
@endsection
