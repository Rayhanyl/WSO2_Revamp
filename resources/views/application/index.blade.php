@extends('app')
@section('content')

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Application <i class="bi bi-pc-display-horizontal"></i></h3>
    </div>
    <div class="page-content">
        <section id="application">
            <div class="row" id="list-application">
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
                                    Setelah login, daftarkan aplikasi Anda dengan cara mengisi formulir Create
                                    Application. Anda akan mendapatkan customer key dan customer secret sebagai
                                    identitas aplikasi Anda.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    Ada 2 jenis key, yaitu Production dan Sandbox. Token ini wajib dikirim ketiika invoke
                                    API sebagai credential aplikasi yang digunakan saat proses autentikasi dan
                                    autorisasi.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    PIlih API yang ingin digunakan dan lakukan subscription dengan level policy yang
                                    tersedia.
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <h4> Create new application !</h4>
                                    <p class="word-break p-2">Creating an Asabri application is easy and
                                        straightforward. So why wait? Join the Asabri revolution today and start
                                        building your application.</p>
                                    <a href="{{ route ('createapplication') }}" class="btn btn-success rounded-pill">Create
                                        Application <i class="bi bi-plus-circle"></i></a>
                                </div>
                                <div class="img-mazer col-12 col-lg-4 d-none d-sm-none d-md-none d-lg-block">
                                    <img class="w-50" src="assets/images/samples/man-with-laptop-light.png"
                                        alt="profile">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider">
                    <div class="divider-text fw-bold bg-transparent">
                        <h4>List Application</h4>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($data->list == null)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h2><i class="bi bi-chevron-double-up"></i></h2>
                                        <h3>Create Application First !</h3>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card">
                                <div class="card-body">
                                    <table class="table" id="listapplication">
                                        <thead>
                                            <tr>
                                                <th>Application name</th>
                                                <th>Shared quota</th>
                                                <th>Subscription</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->list as $item)
                                            <tr>
                                                <td>
                                                    @if ($item->status == 'CREATED' || $item->status == 'REJECTED')
                                                        <img class="img-thumbnail rounded mx-auto d-block" width="75" height="75"
                                                        src="{{asset ('assets/images/samples/app.png')}}" alt="Application Picture">
                                                    @else
                                                        <a href="{{route ('subscription',$item->applicationId)}}">
                                                            <img class="img-thumbnail rounded mx-auto d-block" width="75" height="75"
                                                                src="{{asset ('assets/images/samples/app.png')}}" alt="Application Picture">
                                                        </a>
                                                    @endif
                                                    <p class="text-center">
                                                        {{$item->name}}
                                                    </p>
                                                </td>
                                                <td>{{$item->throttlingPolicy}}</td>
                                                <td>{{$item->subscriptionCount}}</td>
                                                <td>
                                                    <p class="application-description">
                                                        {{$item->description}} 
                                                    </p>
                                                </td>
                                                <td>
                                                    {{ $item->status }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group dropend">
                                                        <button type="button" class="btn btn-outline-primary btn-sm rounded"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-list-ul"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @if ($item->status == 'APPROVED')
                                                            <li>
                                                                <a class="dropdown-item  disabled">
                                                                    <i class="bi bi-key"></i>
                                                                    Manage Keys
                                                                </a>
                                                            </li>
                                                            <li class="ps-4">
                                                                <small>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route ('sandbox',$item->applicationId) }}">
                                                                        Sandbox
                                                                    </a>
                                                                </small>
                                                            </li>
                                                            <li class="ps-4">
                                                                <small>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route ('production',$item->applicationId) }}">
                                                                        Production
                                                                    </a>
                                                                </small>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{route ('subscription',$item->applicationId)}}">
                                                                    <i class="bi bi-bookmarks"></i> Subscription</a>
                                                            </li>
                                                            @endif
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{route ('editapplication',$item->applicationId)}}">
                                                                    <i class="bi bi-pen"></i> Edit Application</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item btn-deleteapp"
                                                                    href="{{route ('deleteapplication',$item->applicationId)}}"><i
                                                                        class="bi bi-trash2"></i> Delete Application</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function () {
        $('#listapplication').DataTable({
            lengthMenu: [
            [5, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        });
    });
    $(document).on('click', '.btn-deleteapp', function (e) {
        e.preventDefault();
        let href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure you want to delete this item?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = href;
            }
        })
    });

</script>
@endpush
@endsection
