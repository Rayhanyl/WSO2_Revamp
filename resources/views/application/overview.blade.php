@extends('app')
@section('content')
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Overview <i class="bi bi-pc-display-horizontal"></i></h3>
    </div>
    <div class="page-content">
        <section id="overview">
            <div class="row">
                <div class="col-12">
                    <h5>
                        <i class="bi bi-yelp"></i> Over View
                    </h5>
                    <hr>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">1. Create Application <i class="bi bi-chevron-double-right"></i></button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">2. Obtain Token <i class="bi bi-chevron-double-right"></i></button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">3. Subscription API <i class="bi bi-chevron-double-right"></i></button>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-1 d-flex justify-content-center">
                                            <h1>
                                                <i class="bi bi-1-circle"></i>
                                            </h1>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <p class="fw-bold p-2">
                                                Setelah login, daftarkan aplikasi Anda dengan cara mengisi formulir Create
                                                Application. Anda akan mendapatkan customer key dan customer secret sebagai
                                                identitas aplikasi Anda.
                                            </p>
                                        </div>
                                        <div class="col-12 col-lg-5 bg-dark rounded text-center">
                                            <img class=" w-50" src="{{ asset ('assets/images/samples/create_app.png') }}" alt="Buat Aplikasi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-1 d-flex justify-content-center">
                                            <h1>
                                                <i class="bi bi-2-circle"></i>
                                            </h1>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <p class="fw-bold">
                                                Ada 2 jenis key, yaitu Production dan Sandbox. Token ini wajib dikirim ketiika invoke
                                                API sebagai credential aplikasi yang digunakan saat proses autentikasi dan
                                                autorisasi.
                                            </p>
                                        </div>
                                        <div class="col-12 col-lg-5 bg-dark rounded text-center">
                                            <img class=" w-50" src="{{ asset ('assets/images/samples/create_app.png') }}" alt="Buat Aplikasi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-1 d-flex justify-content-center">
                                            <h1>
                                                <i class="bi bi-3-circle"></i>
                                            </h1>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <p class="fw-bold">
                                                PIlih API yang ingin digunakan dan lakukan subscription dengan level policy yang
                                                tersedia.
                                            </p>
                                        </div>
                                        <div class="col-12 col-lg-5 bg-dark rounded text-center">
                                            <img class=" w-50" src="{{ asset ('assets/images/samples/create_app.png') }}" alt="Buat Aplikasi">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </section>
    </div>   
</div>
@endsection
