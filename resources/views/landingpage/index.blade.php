@extends('app')
@section('content')

<div class="content-wrapper container">
    <div class="page-content">
        <section id="hero">
            <div class="my-5">
                <div class="row p-4">
                    <div class="col-12 col-lg-7" data-aos="fade-right" data-aos-duration="1800">
                        <h1>Welcome to Asabri API!</h1>
                        <div class="">
                            <h7 class="lh-base">
                                Asabri API is your one-stop solution for all your financial needs. With our API, you can access a wide range of financial services, including payments, transfers, and more. Our API is designed to be easy to use, secure, and reliable, so you can focus on what you do best. Get started today and see the difference Asabri API can make for your business!
                            </h7>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route ('documentation') }}" class="btn btn-primary">Get Started <i class="bi bi-arrow-right-circle"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 d-none d-sm-none d-md-none d-lg-block" data-aos="fade-up" data-aos-duration="1800">
                        <div class="d-flex justify-content-center">
                            <img class="w-50" src="{{ asset ('assets/images/samples/hero-img.png') }}" alt="Hero Picture">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about">
            <div style="margin-top: 7.5em; margin-bottom:5em;">
                <div class="divider" data-aos="fade-down" data-aos-duration="1800">
                    <div class="divider-text fw-bold bg-transparent">
                        <h4>About Us</h4>    
                    </div>
                    <P class="fw-light my-2">
                        Asabri API is a cutting-edge financial technology solution that provides businesses with access to a comprehensive range of financial services. Our API integrates seamlessly with your existing systems, making it easy for you to manage your financial operations from one centralized platform.
                    </P>
                </div>
                <div class="row my-2">
                    <div class="col-12 col-lg-6 text-center my-3" data-aos="fade-right" data-aos-duration="1800">
                        <img class="w-100 rounded shadow-3" src="{{ asset ('assets/images/samples/about.jpg') }}" alt="About Picture">
                    </div>
                    <div class="col-12 col-lg-6 my-3" data-aos="fade-left" data-aos-duration="1800">
                        <h4>With Asabri API</h4>
                        <ul>
                            <li>
                                <p class="text-break">
                                    you can take advantage of a range of services, including payments, transfers, and more. We use the latest security technologies to ensure that your transactions are safe and secure, so you can focus on growing your business without worrying about the security of your financial data.
                                </p>
                            </li>
                            <li>
                                <p class="text-break">
                                    Our API is designed to be user-friendly and intuitive, so you can get started right away without the need for extensive training. Our team of experts is always on hand to provide support and guidance, ensuring that you get the most out of our solution.
                                </p>
                            </li>
                            <li>
                                <p class="text-break">
                                    Whether you're a small business just starting out or a large enterprise looking to streamline your financial operations, Asabri API is the solution you need. Join the growing number of businesses that trust us to provide them with the financial services they need to succeed.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="service">
            <div style="margin-top: 5em; margin-bottom:5em;">
                <div class="divider" data-aos="fade-down" data-aos-duration="1800">
                    <div class="divider-text fw-bold bg-transparent">
                        <h4>Our Services</h4>
                    </div>
                    <P class="fw-light my-2">
                        Explore our API gallery and find out how our API fit to your business case.
                    </P>
                </div>
                <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1800">
                    @foreach ($listapi->list as $item)
                    <div class="zoom col-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="card border">
                            <div class="card-body">
                                <p class="fw-bold">
                                    {{ $item->name }}
                                    <hr>
                                </p>
                                <div class="row">
                                    <div class="col-2">
                                        <h1>
                                            <img class="img-thumbnail rounded mx-auto d-block" width="100" height="100" src="https://avatar.oxro.io/avatar.svg?name={{ $item->name }}"
                                            alt="Application Picture">
                                        </h1>
                                    </div>
                                    <div class="col-10 landingpage-ourservice">
                                        @if ($item->description != null) 
                                            {{ $item->description }}
                                        @else
                                            No description for this API
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="testimonial">
            <div style="margin-top: 5em; margin-bottom:5em;">
                <div class="divider" data-aos="zoom-out" data-aos-duration="800">
                    <div class="divider-text fw-bold bg-transparent">
                        <h4>Testimonials</h4>    
                    </div>
                    <P class="fw-light my-2">
                        What asabri customer are saying.
                    </P>
                </div>
                <div class="row mt-5" data-aos="zoom-in" data-aos-duration="800">
                    <div class="col-12 col-md-4 text-center">
                        <div class="row">
                            <div class="col-12">
                                <img class="img-fluid rounded shadow-2 w-50" src="{{ asset ('assets/images/faces/5.jpg') }}" alt="People Picture">
                            </div>
                            <div class="col-12">
                                <h3>
                                    <i class="bi bi-chevron-double-up"></i>
                                </h3>
                                <p class="fw-bold"> 
                                    Infomedia CX Patners.
                                    <p class="fw-light">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate, voluptates!.
                                    </p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <div class="row">
                            <div class="col-12">
                                <p class="fw-bold"> 
                                    Telkom Corporate.
                                    <p class="fw-light">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate, voluptates!.
                                    </p>
                                </p>
                                <h3>
                                    <i class="bi bi-chevron-double-down"></i>
                                </h3>
                            </div>
                            <div class="col-12">
                                <img class="img-fluid rounded shadow-2 w-50" src="{{ asset ('assets/images/faces/2.jpg') }}" alt="People Picture">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <div class="row">
                            <div class="col-12">
                                <img class="img-fluid rounded shadow-2 w-50" src="{{ asset ('assets/images/faces/3.jpg') }}" alt="People Picture">
                            </div>
                            <div class="col-12">
                                <h3>
                                    <i class="bi bi-chevron-double-up"></i>
                                </h3>
                                <p class="fw-bold"> 
                                    Rans Entertaiment.
                                    <p class="fw-light">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate, voluptates!.
                                    </p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="client">
            <div style="margin-top: 5em;">
                <div class="divider" data-aos="flip-left" data-aos-duration="800">
                    <div class="divider-text fw-bold bg-transparent">
                        <h4>Our Partners</h4>    
                    </div>
                    <P class="fw-light my-2">
                        As a company, we value the partnerships we have built over the years and are committed to fostering long-lasting, mutually beneficial relationships with our partners.
                    </P>
                </div>
                <div class="row" data-aos="flip-right" data-aos-duration="1800">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 col-lg-2">
                                        <div class="card shadow-3">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/1asabri.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/blibli.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/bukalapak.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/swamedia.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-1.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-2.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-3.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-4.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-5.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-6.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-7.png') }}" alt="client">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="img-fluid w-75" src="{{ asset ('assets/images/clients/client-8.png') }}" alt="client">
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
