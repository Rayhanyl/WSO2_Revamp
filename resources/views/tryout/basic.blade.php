<div class="">
    <form class="row" action="#" method="POST">
        @csrf
        <div class="col-12 col-lg-8 p-3">
            <div class="col-sm-12 mb-3">
                <h6>Username :</h6>
                <div class="form-group position-relative has-icon-right">
                    <input type="text" class="form-control round" value="{{ old('username') }}" name="username"
                        placeholder="Username">
                    <div class="form-control-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mb-3">
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
            </div>
            <div class="d-grid gap-2 my-3">
                <button class="btn btn-primary rounded-pill" type="submit">Sign In <i
                        class="bi bi-box-arrow-in-right"></i></button>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <h3>Gateway</h3>
            <hr>
            <div>
                <select class="form-select" aria-label="gateway" name="gateway">
                    <option>-- API Gateways --</option>
                    <option value="default" selected>Default</option>
                </select>
                <div id="gateway" class="form-text">
                    Please select an environment            
                </div>
            </div>
        </div>
    </form>
</div>

@push('script')
<script>
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
@endpush
