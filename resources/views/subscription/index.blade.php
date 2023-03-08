@extends('app')
@section('content')

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Subscription <i class="bi bi-bookmarks"></i></h3>
    </div>
    <div class="page-content">
        <section id="subscription">
            <div id="list-subscription" class="row">
                <div class="col-12 my-2">
                    <a href="{{ route ('application', $application->applicationId) }}">
                        <h5>
                            <i class="bi bi-arrow-left-circle"></i> Back to Application
                        </h5>
                    </a>
                </div>
                <div class="col-12 col-lg-4" data-aos="fade-right" data-aos-duration="1200">
                    <div class="bg-subscription card">
                        <div class="card-body">
                            <h5>Total Subscriptions</h5>
                            <h1 class="text-warning">{{ $subscription->count }}</h1>
                            <small class="fw-bold"">{{ $application->name }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8" data-aos="fade-left" data-aos-duration="1200">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-12 col-lg-4">
                                <div>
                                    <h5 class="text-capitalize">{{ session('firstname') }} {{ session('lastname') }}</h5>
                                    <h7>{{ $application->throttlingPolicy }}</h7>
                                </div>
                                <div class="d-flex justify-content-start mt-3">
                                    <a href="{{ route ('createsubscription',$application->applicationId) }}" class="btn btn-success rounded-pill">Start subscription API <i class="bi bi-bookmark-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <h6>
                                   Apps description: 
                                </h6>
                                <p class="text-break subscription-description">
                                    @if ($application->description == null)
                                    <div class="text-center">
                                        <p class="">This application don't have description.</p>
                                    </div>    
                                    @endif
                                    {{ $application->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" data-aos="fade-up" data-aos-duration="1200">
                    <div class="card">
                        <div class="card-body">
                            @if ($subscription->list == null)
                            <div class="">
                                <h3>Add subscriptions</h3>
                                <p class="fw-bold text-warning">No subscriptions are available for this Application <i class="bi bi-exclamation-diamond"></i></p>
                            </div>
                            @else
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        List Subscription
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table text-center" id="listsubscribe">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">API</th>
                                                <th class="text-center">Lifecycle State</th>
                                                <th class="text-center">Business Plan</th>
                                                <th class="text-center">Subscription Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subscription->list as $items)
                                            <tr>
                                                <td>
                                                    <img class="img-thumbnail rounded mx-auto d-block" width="50" height="50"
                                                    src="https://avatar.oxro.io/avatar.svg?name={{$items->apiInfo->name}}"
                                                    alt="Application Picture">
                                                </td>
                                                <td>{{$items->apiInfo->name}} - {{$items->apiInfo->version}} </td>
                                                <td>{{$items->apiInfo->lifeCycleStatus}}</td>
                                                <td>{{$items->throttlingPolicy}}</td>
                                                <td>
                                                    @if ($items->status == 'ON_HOLD')
                                                        <p data-toggle="tooltip" data-placement="left" title="Waiting for approval from admin"> 
                                                            {{$items->status}} 
                                                        </p>
                                                    @elseif($items->status == 'REJECTED')
                                                        <p data-toggle="tooltip" data-placement="left" title="Rejected"> 
                                                            {{$items->status}} 
                                                        </p>
                                                    @else
                                                        <p data-toggle="tooltip" data-placement="left" title="Approved"> 
                                                            {{$items->status}} 
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($items->status == 'REJECTED')
                                                    <button type="button" class="btn btn-warning btn-edit-subs" data-subs-id="{{ $items->subscriptionId }}" disabled>
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    @elseif($items->status == 'ON_HOLD')
                                                    <button type="button" class="btn btn-warning btn-edit-subs" data-subs-id="{{ $items->subscriptionId }}" disabled>
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn btn-warning btn-edit-subs" data-subs-id="{{ $items->subscriptionId }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <a class="btn btn-success"
                                                         href="{{ route ('tryout',$application->applicationId) }}">
                                                         Tryout
                                                        <i class="bi bi-link"></i>
                                                     </a>
                                                    @endif
                                                    <a class="btn btn-danger btn-deletesubs"
                                                        href="{{ route ('deletesubscription',$items->subscriptionId) }}">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
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

@include('subscription.modal.modalsubs')


@push('script')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
        var modal = new bootstrap.Modal(document.getElementById('subscription-modal'));
        var jqmodal = $('#subscription-modal');
        var loaderModal = $('#modalLoader');
        var contentModal = $('#modalContent');
        $(document).on('click', '.btn-edit-subs', function() {
            modal.show();
            jqmodal.find('.modal-title').html('Update Subscription');
            $('.btn-submit').show();
            jqmodal.find('.btn-submit').attr('form', 'form-edit-subscription');
            var idsubs = $(this).data('subs-id');
            $.ajax({
                type: "GET",
                url: '{{ route('editsubscription') }}',
                dataType: 'html',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_subs: idsubs,
                },
                beforeSend: function() {
                    contentModal.html('');
                    loaderModal.html(
                        '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                    );
                },
                success: function(data) {
                    contentModal.html(data);
                },
                complete: function() {
                    loaderModal.html('');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                    contentModal.html(pesan);
                },
            });
        }); 


        $(document).on('click', '.btn-deletesubs', function(e){
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
                    window.location.href=href;
                }
            })
        });

        $(document).ready(function () {
            $('#listsubscribe').DataTable();
        });
    </script>
@endpush

@endsection