@extends('app')
@section('content')

<div class="content-wrapper container mb-5">
    <div class="page-heading">
        <h3>TryOut <i class="bi bi-clipboard2-data"></i></h3>
    </div>
    <div class="page-content">
        <section id="tryout">
            <div class="row">
                <div class="col-12" data-aos="fade-right" data-aos-duration="1000">
                    <div class="tryout-background card">
                        <div class="card-body row">
                            <div class="col-12 col-lg-4">
                                <h3 class="text-capitalize">{{ $application->name }}</h3>
                                <p>{{ $application->throttlingPolicy }}</p>
                                <h6>Subscription API</h6>
                                <p class="text-warning fs-3">{{ $application->subscriptionCount }}</p>
                            </div>
                            <div class="col-12 col-lg-8">
                                <p class="fw-bold text-break">
                                    Apps Description: <br>
                                    <small class="text-muted application-description">{{ $application->description }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" data-aos="fade-left" data-aos-duration="1000">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-center fw-bold mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-oauth-tab" data-bs-toggle="pill" data-bs-target="#pills-oauth" type="button" role="tab" aria-controls="pills-oauth" aria-selected="true">OAuth</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-apikey-tab" data-bs-toggle="pill" data-bs-target="#pills-apikey" type="button" role="tab" aria-controls="pills-apikey" aria-selected="false">API key</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button" role="tab" aria-controls="pills-basic" aria-selected="false">Basic</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-oauth" role="tabpanel" aria-labelledby="pills-oauth-tab" tabindex="0">
                                  @include('tryout.oauth')
                                </div>
                                <div class="tab-pane fade" id="pills-apikey" role="tabpanel" aria-labelledby="pills-apikey-tab" tabindex="0">
                                  @include('tryout.apikey')
                                </div>
                                <div class="tab-pane fade" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab" tabindex="0">
                                  @include('tryout.basic')
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="divider" data-aos="fade-down" data-aos-duration="1000">
                    <div class="divider-text fw-bold bg-transparent">
                        <h4>Swagger 3.0</h4>
                    </div>
                </div>
                <div class="col-12" data-aos="fade-down" data-aos-duration="1000">
                    <div class="card">
                        <div class="card-body">
                            <div id="swagger-ui"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('script')
    <script>
        function toggleOauth() {
            var passwordField = document.getElementById("accesstoken-oauth");
            var toggleBtn = document.getElementById("toggle-accesstoken-oauth");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        function toggleApikey() {
            var passwordField = document.getElementById("accesstoken-apikey");
            var toggleBtn = document.getElementById("toggle-accesstoken-apikey");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        window.onload = () => {
            const paramsString = window.location.href;
            const searchParams = new URLSearchParams(paramsString);
            const access_token = searchParams.toString().split('=')[1].split('&')[0];
            //console.log(searchParams.toString().split('=')[1].split('&')[0]);
            //for (const p of searchParams) {
            //  console.log(p);
            //}
            window.ui = SwaggerUIBundle({
            url: '{{ route ('swaggerjson') }}',
            dom_id: '#swagger-ui',
            deepLinking: true,
            filter:false,
            presets: [
                SwaggerUIBundle.presets.apis
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            oauth2RedirectUrl: 'http://localhost/swagger.html',
            requestInterceptor: (req) => {
                req.headers['Authorization'] ='Bearer ' + access_token;
                return req;
            }
            });
        };
    </script>
@endpush

@endsection