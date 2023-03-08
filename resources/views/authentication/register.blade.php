<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account Page ASABRI</title>
    <link rel="stylesheet" href="{{ asset ('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/css/main/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset ('assets/images/logo/icon-asabri.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset ('assets/images/logo/icon-asabri.png') }}" type="image/png">
    <link rel="stylesheet" href="{{asset ('assets/aos/aos.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
</head>
<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="{{ route ('login') }}"><i class="bi bi-chevron-left"></i> <strong class="fw-bold">Back To Login Page</strong> </a>
        </div>
    </nav>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Signing up for an Asabri account is quick and easy</h4>
            <p class="fw-light">
                Simply provide us with some basic information about yourself, and we'll take care of the rest. Our secure platform allows you to manage your investments from anywhere, at any time.
            </p>
        </div>
        <div class="card-body bg-login">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="text-center p-3">
                        <img class="img-fluid w-25" src="{{ asset ('assets/images/logo/asabri.png') }}" alt="login picture">
                    </div>
                    <div class="card card-morp">
                        <div class="card-body">
                            <form action="{{ route ('authregister') }}" method="POST" class="form">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 @error('firstname') is-invalid @enderror">
                                        <h6>First name :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="text" class="form-control round" name="firstname" value="{{old('firstname')}}"
                                            placeholder="Enter your first name.">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-video"></i>
                                            </div>
                                            @error('firstname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 @error('lastname') is-invalid @enderror">
                                        <h6>Last name :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="text" class="form-control round" name="lastname" value="{{old('lastname')}}"
                                            placeholder="Enter your last name.">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-video"></i>
                                            </div>
                                            @error('lastname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 @error('userlogin') is-invalid @enderror">
                                        <h6>Username :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="text" class="form-control round" name="userlogin" value="{{old('userlogin')}}"
                                            placeholder="Enter your username.">
                                            <div id="username" class="form-text">This username for login application.</div>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-badge-fill"></i>
                                            </div>
                                            @error('userlogin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 @error('phone') is-invalid @enderror">
                                        <h6>Phone number :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="text" class="form-control round" name="phone" value="{{old('phone','+62')}}"
                                            placeholder="Enter your phone number.">
                                            <div id="phonenumber" class="form-text">Please enter the correct mobile number.</div>
                                            <div class="form-control-icon">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mb-2 @error('email') is-invalid @enderror">
                                        <h6>Email :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="email" class="form-control round" name="email" value="{{old('email')}}"
                                            placeholder="Enter your email address.">
                                            <div id="email" class="form-text">Enter an active email address.</div>
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2  @error('password') is-invalid @enderror">
                                        <h6>Password :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="password" class="form-control round" name="password" id="password"
                                            placeholder="Enter your password.">
                                            <div class="form-text">We'll never share your password with anyone else.</div>
                                            <div class="form-control-icon">
                                                <i id="toggle-password" onclick="togglePassword()" class="bi bi-eye"></i>
                                            </div>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2  @error('password_confirmation') is-invalid @enderror">
                                        <h6>Password Confirmation :</h6>
                                        <div class="form-group position-relative has-icon-right">
                                            <input type="password" class="form-control round" name="password_confirmation" id="password_confirmation"
                                            placeholder="Enter your password confirmation.">
                                            <div class="form-control-icon">
                                                <i id="toggle-password-confirm" onclick="confirmPassword()" class="bi bi-eye"></i>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 my-3">
                                        <button class="btn btn-primary rounded-pill" type="submit">Register an account <i class="bi bi-person-plus-fill"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-center d-none d-sm-none d-md-none d-lg-block my-auto">
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
    var passwordField = document.getElementById("password_confirmation");
    var toggleBtn = document.getElementById("toggle-password-confirm");
    if (passwordField.type === "password") {
      passwordField.type = "text";
    } else {
      passwordField.type = "password";
    }
  }
</script>
</body>
</html>
