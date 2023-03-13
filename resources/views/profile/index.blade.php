@extends('app')
@section('content')

@push('style')
    <style>
        .img-profile{
            background-size: cover;
            background-repeat: no-repeat;
        }    
    </style>    
@endpush

<div class="content-wrapper container mb-5">
    <div class="page-heading">
        <h3>My Profile <i class="bi bi-person-badge"></i></h3>
        <div class="page-content">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-12 col-lg-12">
                                <h4 class="text-capitalize">{{ session('firstname') }} {{ session('lastname') }}</h4>
                                <p>{{ session('email') }}</p> 
                                <p>{{ session('phone') }}</p>                               
                            </div>
                            <div class="my-2">
                                <hr>
                            </div>
                            <div class="col-12"> 
                                <form action="{{ route ('changepassword') }}" method="POST" class="row g-3">
                                    @csrf
                                    <div class="col-12">
                                        <h6>Change password:</h6>
                                    </div>
                                    <div class="col-auto">
                                        <label for="inputPassword2" class="visually-hidden">Password</label>
                                        <input type="password" class="form-control" name="currentpassword" id="currentpassword" placeholder="Current Password">
                                    </div>
                                    <div class="col-auto">
                                        <label for="inputPassword2" class="visually-hidden">Password</label>
                                        <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <img class="rounded mx-auto d-block" width="280" height="280"
                    src="{{ asset ('assets/images/samples/profile.png') }}"
                    alt="Application Picture">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


