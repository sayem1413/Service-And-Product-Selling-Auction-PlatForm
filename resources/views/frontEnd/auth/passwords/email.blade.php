@extends('frontEnd.master1')

@section('title')
Send Reset Link
@endsection

@section('mainContent')
<hr/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Send Reset Password Link</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" id="form_email">
                        @csrf

                        <br/>
                        <div class="form-group row">
                            <div class="col-md-4">
                               <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label> 
                            </div>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
@endsection
