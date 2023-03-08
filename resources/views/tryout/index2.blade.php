@extends('app')
@section('content')

@push('style')
<style>
.custom-tooltip{
  --bs-tooltip-bg: var(--bs-primary);
}
</style>
@endpush

<div class="content-wrapper container mb-5">
    <div class="page-heading">
        <h3>List resource API <i class="bi bi-collection"></i></h3>
    </div>
    <div class="page-content">
        <section id="tryout">
            <div class="row">
                <div class="col-12 my-2">
                    <h5>
                        <a type="button" class="reset-local-storage" href="{{ route ('application', $application->applicationId) }}">
                            <i class="bi bi-arrow-left-circle"></i> Back to Application
                        </a>
                    </h5>
                </div>
                @if ($subscription->list == null)
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1>Subscribe to the API first to try it</h1>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-12 row">
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" action="#" method="GET">
                                    <div class="col-12">
                                        <label class="fw-bold" for="select-api-tryout">Select API:</label>
                                        <select class="form-select" aria-label="Select API Tryout" id="select-api-tryout" name="select-api-tryout" required>
                                            <option>-- Select API --</option>
                                            @foreach ($subscription->list as $items)
                                            <option value="{{ $items->apiInfo->id }}" data-toggle="tooltip" data-placement="top"
                                              title="{{ $items->apiInfo->description}} ">
                                              {{ $items->apiInfo->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 my-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="callback-url" id="sandbox-callback" value="SANDBOX" checked>
                                            <label class="form-check-label" for="sandbox-callback">Sandbox</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="callback-url" id="production-callback" value="PRODUCTION">
                                            <label class="form-check-label" for="production-callback">Production</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary my-3" id="find-swagger-api" type="submit"> Submit API </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8" id="detail-api-tryout">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-12 col-lg-4">
                                    <h6 class="text-capitalize">{{ $application->name }}</h6>
                                    <p>{{ $application->throttlingPolicy }}</p>
                                    <p>Subscription API : {{ $application->subscriptionCount }}</p>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <p class="text-break">
                                        Apps Description :
                                        <small class="tryout-description">
                                            {{ $application->description }}
                                        </small>
                                    </p>
                                </div>
                                <hr>
                                <div class="col-12 row">
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            @if (isset($sandbox->consumerKey))
                                                <div class="col-12">
                                                    <p class="fw-bold">Sandbox</p>
                                                </div>
                                                <div class="col-auto">
                                                    <input type="text" class="form-control form-control-sm" id="sandbox-consumer-key" placeholder="Consumer key" value="{{ $sandbox->consumerKey ?? '' }}">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" onclick="copyConsumerkeySandbox()"  class="btn btn-success btn-sm mb-3">Copy Client ID</button>
                                                </div>
                                            @else
                                                <p class="fs-5">Generate sandbox key first, <br> to get client id </p>
                                                <p>
                                                    <a type="button" class="btn btn-success btn-sm reset-local-storage" href="{{ route ('sandbox',$application->applicationId) }}">Click here!</a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                            <div class="row">
                                                @if (isset($production->consumerKey))
                                                    <div class="col-12">
                                                        <p class="fw-bold">Production</p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="text" class="form-control form-control-sm" id="production-consumer-key" placeholder="Consumer key" value="{{ $production->consumerKey ?? '' }}">
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" onclick="copyConsumerkeyProduction()"  class="btn btn-success btn-sm mb-3">Copy Client ID</button>
                                                    </div>
                                                @else 
                                                    <p class="fs-5">Generate production key first, <br> to get client id </p>
                                                    <p>
                                                        <a type="button" class="btn btn-success btn-sm reset-local-storage" href="{{ route ('production',$application->applicationId) }}">Click here!</a>
                                                    </p>
                                                @endif
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12" id="swagger-api-tryout" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-12 text-end">
                                        <p class="fw-bold">
                                            
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <a class="button" id="download-file-postman" data-id="">
                                            <img src="{{ asset ('assets/images/logo/postman.png') }}" width="120" height="30" alt="Postman Collection">
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a class="button" id="download-file-openapi" data-id="">
                                            <img src="{{ asset ('assets/images/logo/openapi.png') }}" width="120" height="30" alt="OpenAPI">
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div id="swagger-ui"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </section>
    </div>
</div>
@push('script')
<script>

    $(document).ready(function (){
        const value = localStorage.getItem('jsonapiswagger');
        const value2 = localStorage.getItem('jsonapiswagger2');
        const value3 = localStorage.getItem('jsonapiswagger3');

        if (value !== null && value2 !== null && value3 !== null) {
            tryval = value;
            calurl = value2;
            calval= value3;

            $('#download-file-postman').data('id', tryval);
            $('#download-file-openapi').data('id', tryval);

            $("input[name='callback-url'][value='" + calval + "']").prop("checked", true);
            $("#select-api-tryout").val(tryval).change();
            $('#swagger-api-tryout').show();
            swaggeruiload(tryval,calurl);
        }else{
            $('#swagger-api-tryout').hide();
        }
    });

    $(document).on('click', '#find-swagger-api', function(e) {
        e.preventDefault();
        let calval = $("input[name='callback-url']:checked").val();
        let calurl = '';
        let tryval = $('#select-api-tryout').val();

        $('#download-file-postman').data('id', tryval);
        $('#download-file-openapi').data('id', tryval);

        if (calval == 'SANDBOX') {
            calurl = '{{ $sandbox->callbackUrl ?? '' }}';
        }else{
            calurl = '{{ $production->callbackUrl ?? '' }}';
        }

        $('#swagger-api-tryout').show();
        swaggeruiload(tryval,calurl);
        localStorage.setItem('jsonapiswagger', tryval);
        localStorage.setItem('jsonapiswagger2', calurl);
        localStorage.setItem('jsonapiswagger3', calval);
    });


    $(document).on('click','#download-file-openapi', function(e){
        e.preventDefault();
        window.location.href = "{{route ('downloadjsonopenapi')}}?id_api="+$(this).data('id');
        
    });

    function swaggeruiload (id,url) {
        const paramsString = window.location.href;
        const searchParams = new URLSearchParams(paramsString);
        const access_token = searchParams.toString().split('=')[1].split('&')[0];

        window.ui = SwaggerUIBundle({
        url: '{{ route ('swaggerjson') }}'+'?id_api='+id,
        dom_id: '#swagger-ui',
        deepLinking: true,
        filter:false,
        presets: [
            SwaggerUIBundle.presets.apis
        ],
        plugins: [
            SwaggerUIBundle.plugins.DownloadUrl
        ],  
        oauth2RedirectUrl: url,
            requestInterceptor: (req) => {
                req.headers['Authorization'] ='Bearer ' + access_token;
                return req;
            }
        });
    }


    function copyConsumerkeySandbox() {
        var copyText = document.getElementById("sandbox-consumer-key");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        Swal.fire(
            'Already Copied',
            '',
            'success'
        )
    }

    function copyConsumerkeyProduction() {
        var copyText = document.getElementById("production-consumer-key");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        Swal.fire(
            'Already Copied',
            '',
            'success'
        )
    }
</script>
@endpush
@endsection
