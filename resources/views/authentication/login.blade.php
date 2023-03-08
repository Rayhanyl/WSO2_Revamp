<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page ASABRI</title>
    <link rel="stylesheet" href="{{ asset ('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/css/main/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset ('assets/images/logo/icon-asabri.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset ('assets/images/logo/icon-asabri.png') }}" type="image/png">
    <link rel="stylesheet" href="{{asset ('assets/aos/aos.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="{{ route ('landingpage') }}"><i class="bi bi-chevron-left"></i> <strong class="fw-bold">Back To
                    LandingPage</strong> </a>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Welcome to ASABRI! 👋</h4>
                <p class="fw-light">
                    Please sign-in to your account and start the adventure.
                </p>
            </div>
            <div class="card-body bg-login">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="text-center p-3">
                            <img class="img-fluid w-25" src="{{ asset ('assets/images/logo/asabri.png') }}"
                                alt="login picture">
                        </div>
                        <div class="card card-morp">
                            <div class="card-body">
                                <form id="formAuthentication" class="mb-3" action="{{ route ('authentication') }}"
                                    method="POST">
                                    @csrf
                                    <div class="col-sm-12 mb-3 @error('username') is-invalid @enderror">
                                        <h6>Username :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="text" class="form-control round" value="{{ old('username') }}"
                                                name="username" placeholder="Username">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </div>
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 text-end">
                                        <small class="text-muted">
                                            <a href="{{ route ('forget') }}">
                                                Forget Password?
                                            </a>
                                        </small>
                                    </div>
                                    <div class="col-sm-12 mb-3 @error('password') is-invalid @enderror">
                                        <h6>Password :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="password" class="form-control round" name="password" id="password"
                                                placeholder="Password">
                                            <div class="form-text">We'll never share your password with
                                                anyone else.</div>
                                            <div class="form-control-icon">
                                                <i id="toggle-password" onclick="togglePassword()" class="bi bi-eye"></i>
                                            </div>
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2 my-3">
                                        <button class="btn btn-primary rounded-pill" type="submit">Sign In <i
                                                class="bi bi-box-arrow-in-right"></i></button>
                                    </div>
                                </form>
                                <div class="my-2">
                                    <p class="text-center">
                                        <span>New on our platform?</span>
                                        <a href="{{ route ('register') }}">
                                            <span>Create an account</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 text-center my-auto d-none d-md-block">
                        <img class="w-75" src="{{ asset ('assets/images/samples/hero-img.png') }}" alt="Hero Picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset ('assets/js/jquery-3.6.1.js')}}"></script>
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleBtn = document.getElementById("toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
