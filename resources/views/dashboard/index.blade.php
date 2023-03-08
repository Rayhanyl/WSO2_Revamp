@extends('app')
@section('content')

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>ASABRI API</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row" data-aos="fade-up" data-aos-duration="1800">
                    <div class="col-12" data-aos="fade-right" data-aos-duration="2000">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-8">
                                        <p class="fs-5 text-warning">
                                            <i class="bi bi-info-circle"></i>
                                        </p>
                                        <h4 class="text-capitalize"> Welcome {{ session('firstname') }} {{ session('lastname') }} !</h4>
                                        <p class="word-break p-2">Explore our API gallery and find out how our API fit to your business case.</p>
                                        <a href="{{ route ('application') }}" class="btn btn-primary rounded-pill">Get Started</a>
                                    </div>
                                    <div class="col-12 col-lg-4 my-2">
                                        <div class="card bg-dark">
                                            <div class="card-body px-2 py-2-3">
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                                        <div class="stats-icon blue mb-2">
                                                            <i class="iconly-boldProfile"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                        <h6 class="text-muted font-semibold">
                                                            <a href="#" class="text-secondary">
                                                                Applicattion
                                                            </a>
                                                        </h6>
                                                        <h6 class="font-extrabold mb-0">{{ $application->count }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <img class="w-50" src="assets/images/samples/man-with-laptop-light.png" alt="profile"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" data-aos="fade-left" data-aos-duration="2000">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="bi bi-yelp"></i> Over View
                                        </h5>
                                        <hr>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1. Create Application <i class="bi bi-chevron-double-right"></i></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">2. Obtain Token <i class="bi bi-chevron-double-right"></i></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">3. Subscription API <i class="bi bi-chevron-double-right"></i></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <p class="my-4">
                                                    Setelah login, daftarkan aplikasi Anda dengan cara mengisi formulir Create
                                                    Application. Anda akan mendapatkan customer key dan customer secret sebagai
                                                    identitas aplikasi Anda.
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <p class="my-4">
                                                    Ada 2 jenis key, yaitu Production dan Sandbox. Token ini wajib dikirim ketiika invoke
                                                    API sebagai credential aplikasi yang digunakan saat proses autentikasi dan
                                                    autorisasi.
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                <p class="my-4">
                                                    PIlih API yang ingin digunakan dan lakukan subscription dengan level policy yang
                                                    tersedia.
                                                </p>
                                            </div>
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