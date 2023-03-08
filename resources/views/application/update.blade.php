@extends('app')
@section('content')
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Update Application <i class="bi bi-pc-display-horizontal"></i></h3>
    </div>
    <div class="page-content">
        <section id="application">
            <div class="row" id="list-application">
                <div class="col-12" data-aos="fade-right" data-aos-duration="2000">
                    <div class="card">
                        <div class="card-body">
                            <form class="form row g-3" action="{{ route ('updateapplication', $data->applicationId) }}"
                                method="POST">
                                @csrf
                                <div class="col-12 col-md-6 @error('appname') is-invalid @enderror">
                                    <label for="appname" class="form-label">Application Name</label>
                                    <input type="text" class="form-control" id="appname" name="appname"
                                        value="{{$data->name}}" required>
                                    <div id="appname" class="form-text">Enter a name to identify the Application. You
                                        will be able to pick this application when subscribing to APIs.</div>
                                    @error('appname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 @error('shared') is-invalid @enderror">
                                    <label for="shared" class="form-label">Shared Quota</label>
                                    <select class="form-select" aria-label="Choice Shared Quota" id="shared"
                                        name="shared" required>
                                        @foreach ($options->list as $item)
                                        <option value="{{$item->name}}"
                                            {{ $item->name == $data->throttlingPolicy ? 'selected' : '' }}
                                            data-toggle="tooltip" data-placement="top" title="{{$item->description}}">
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="shared" class="form-text">Assign API request quota per access token.
                                        Allocated quota will be shared among all the subscribed APIs of the application.
                                    </div>
                                    @error('shared')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 @error('description') is-invalid @enderror">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3"
                                        name="description">{{$data->description}}</textarea>
                                    <div id="description" class="form-text">
                                        Maximum character 512.
                                        <div id="the-count">
                                            <span id="current">0</span>
                                            <span id="maximum">/ 512</span>
                                        </div>
                                    </div>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    <a href="{{ route ('application') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('script')
    <script>
        $('textarea').keyup(function() {
        
            var characterCount = $(this).val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');
            
            current.text(characterCount);
            
        });
    </script>
@endpush
@endsection
