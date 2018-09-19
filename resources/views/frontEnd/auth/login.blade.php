@extends('frontEnd.master1')

@section('title')
Login
@endsection

@section('mainContent')

<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <div class="sign-in-form">
            <div class="sign-in-form-top">
                <h1>Log in</h1>
            </div>
            <div class="signin">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" id="form_login">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="off" autofocus required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success btn-block">
                                Login
                            </button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="new_people">
                <h2>For New People</h2>
                <p>If you are new here please click Register for Sign-in.</p>
                <a href="{{ route('register') }}">Register Now!</a>
            </div>
        </div>
    </div>
</div>
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
@endsection
