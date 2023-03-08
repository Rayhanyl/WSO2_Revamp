<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password Page ASABRI</title>
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
            <a href="{{ route ('login') }}"><i class="bi bi-chevron-left"></i> <strong class="fw-bold">Back To Login
                    Page</strong> </a>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Reset Your Password and Get Back to Investing with Asabri 🔒.</h4>
                <p class="fw-light">
                    To reset your password, simply click the "Forgot Password" link on the login page and follow the
                    instructions. You'll be asked to enter the email associated with your account, and we'll send you a
                    password reset link.
                </p>
            </div>
            <div class="card-body bg-login">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="text-center p-3">
                            <img class="img-fluid w-25" src="{{ asset ('assets/images/logo/asabri.png') }}"
                                alt="login picture">
                        </div>
                        <div class="card card-morp">
                            <div class="card-body">
                                @if ($status == '400')
                                <div class="invalid-code">
                                    <p class="fw-bold text-danger fs-4">
                                        Code confirmation is not valid <i class="bi bi-exclamation-diamond"></i>
                                    </p>
                                    <p class="text-secondary text-uppercase">
                                        {{ $invalid }}
                                        <hr>
                                    </p>
                                </div>
                                @else
                                <form action="{{ route ('resetpassword') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="confirmation" value="{{ $confirmation }}">
                                    <div class="col-sm-12 mb-3 @error('password') is-invalid @enderror">
                                        <h6>New Password :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="password" class="form-control round"
                                                placeholder="Enter your new password." name="password" id="password"
                                                value="{{ old('password') }}">
                                            <div class="form-control-icon">
                                                <i id="toggle-password" onclick="togglePassword()"
                                                    class="bi bi-eye"></i>
                                            </div>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3 @error('password_confirmation') is-invalid @enderror">
                                        <h6>Confirmation New Password :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="password" class="form-control round"
                                                placeholder="Enter your new password." name="password_confirmation"
                                                id="password_confirmation" value="{{ old('password_confirmation') }}">
                                            <div class="form-control-icon">
                                                <i id="toggle-new-password" onclick="confirmPassword()"
                                                    class="bi bi-eye"></i>
                                            </div>
                                            @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 my-3">
                                        <button class="btn btn-primary rounded-pill" type="submit">Reset password <i
                                                class="bi bi-arrow-clockwise"></i></button>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 text-center">
                        <img class="w-75" src="{{ asset ('assets/images/samples/hero-img.png') }}" alt="Hero Picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset ('assets/js/jquery-3.6.1.js')}}"></script>
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

        function confirmPassword() {
            var passwordField = document.getElementById("newpassword");
            var toggleBtn = document.getElementById("toggle-new-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

    </script>
</body>

</html>
