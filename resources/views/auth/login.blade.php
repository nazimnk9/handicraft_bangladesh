<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $data['company'] = App\Model\Company::first();
        $data['logo'] = App\Model\Logo::first();
    @endphp
    <title>{{$data['company']->name}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('public/upload/logo_images/'.$data['logo']->image)}}"/>

<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/vendor/animate/animate.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend')}}/css/main.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <div>
                            <span class="login100-form-logo">
                                <i class="zmdi zmdi-landscape"></i>
                            </span>
                        </div>
                        <div>
                            <span class="login100-form-title p-b-34 p-t-27">
                                {{$data['company']->name}}
                            </span>
                        </div>
                    </div>

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          @foreach($errors->all() as $error)
                          <strong>{{$error}}</strong><br/>
                          @endforeach
                        </div>
                        @endif

                        @if(Session::get('message'))
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>{{Session::get('message')}}</strong>
                        </div>
                        @endif

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email Address" value="{{ old('email') }}" autocomplete="email" autofocus>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" autocomplete="current-password">
                    </div><br>
                    <div class="container-login100-form-btn">
                        <button type="submit" name="button" class="login100-form-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{asset('public/backend')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{asset('public/backend')}}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('public/backend')}}/js/main.js"></script>

</body>
</html>
