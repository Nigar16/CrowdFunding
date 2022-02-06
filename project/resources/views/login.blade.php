<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login Page</title>

    <meta name="description" content=" Login Page"/>
    <meta name="author" content="Nigar"/>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon.png') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{asset('assets/login.png')}}" class="img-fluid" style="width:70%">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form  method="POST" action="#">
                    @csrf
                    @include('layouts.errors')
                    @if(session('error_login'))
                        <div class="alert alert-danger">
                            <p>E-mail or password is incorrect!</p>
                        </div>
                    @endif

                    <h2 class="text-center mb-3">Log in</h2>

                    <div class="form-outline mb-4">
                        <input type="email" id="form3Example3" class="form-control form-control-lg"
                               name="email" placeholder="Enter a valid email address" />
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" id="form3Example4" class="form-control form-control-lg"
                               name="password"  placeholder="Enter password" />
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-dark btn-lg" type="submit">Log in</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-dark">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Crowdfunding © {{date("Y")}}
        </div>
    </div>
</section>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</script>
</body>

</html>
