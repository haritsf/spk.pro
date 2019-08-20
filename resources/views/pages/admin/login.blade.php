<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
        name="viewport">
    <title>spk.promethee</title>
    <link rel="icon" type="image/png" href="{{url('img/logo.png')}}" sizes="32x32">
    <link rel="stylesheet" href="{{url('modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('modules/bootstrap-social/bootstrap-social.css')}}">
    <link rel="stylesheet" href="{{url('modules/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
    <link rel="stylesheet" href="{{url('css/landing.css')}}">

    <link
        href="https://fonts.googleapis.com/css?family=Product+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">
</head>

<body>
    <section class="section" style="padding-top:100px">
        <div class="container" style="font-family: Product Sans">
            <div class="row shadow">
                <div class="col-4">
                    <div class="card mb-0">
                        <div class="login-brand mt-5">
                            <img src="{{url('img/logo.png')}}" alt="logo" width="50"> promethee
                        </div>
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{url('/admin/home')}}" class="needs-validation" novalidate="">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" tabindex="1"
                                        required autofocus>
                                    <div class="invalid-feedback">
                                        Please fill in your username
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                        <div class="float-right">
                                            <a href="auth-forgot-password.html" class="text-small">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password"
                                        tabindex="2" required>
                                    <div class="invalid-feedback">
                                        please fill in your password
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                            {{-- <div class="row sm-gutters">
                                <div class="col-6">
                                    <a class="btn btn-block btn-social btn-facebook">
                                        <span class="fab fa-facebook"></span> Facebook
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-block btn-social btn-google">
                                        <span class="fab fa-google"></span> Google
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div> --}}
                    </div>
                </div>
                <div class="col-8" style="background:url('../img/unsplash/ground.jpg')">
                </div>
            </div>
        </div>
    </section>

    <script src="{{url('modules/jquery.min.js')}}"></script>
    <script src="{{url('modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/stisla.js')}}"></script>
    <script src="{{url('js/scripts.js')}}"></script>
    <script src="{{url('js/custom.js')}}"></script>
</body>

</html>