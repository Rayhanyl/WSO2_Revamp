@extends('app')
@section('content')

<div class="content-wrapper container mb-5">
    <div class="page-heading">
        <h3>Manage Keys <i class="bi bi-gear"></i></h3>
    </div>
    <div class="page-content">
        <section id="managekeys">
            <div class="row" data-aos="fade-right" data-aos-duration="1800">
                <div class="col-12 my-2 row">
                    <div class="col-6">
                        <a href="{{ route ('application') }}">
                            <h5>
                                <i class="bi bi-arrow-left-circle"></i> Back to Application
                            </h5>
                        </a>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route ('production',$application->applicationId) }}">
                            <h5>
                                Production <i class="bi bi-arrow-right-circle"></i>
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="divider">
                    <div class="divider-text fw-bold bg-transparent">
                        <h3>Sandbox <i class="bi bi-box-fill"></i></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="row sticky-lg-top">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col-12">
                                        <h3 class="text-capitalize">{{ $application->name }}</h3>
                                    </div>
                                    <div class="col-6 my-2">
                                        <h6 class="text-secondary">{{ $application->throttlingPolicy }}</h6>
                                    </div>
                                    <div class="col-6 my-2">
                                        <h6 class="text-success">{{ $application->status }}</h6>
                                    </div>
                                    <p class="fw-bold">Description :</p>
                                    <div class="col-12 fw-light text-break">
                                        {{ $application->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        @if (isset($data->keyMappingId))
                                        <button class="btn btn-outline-primary fw-bold generate" type="submit"
                                            form="generatekey">
                                            <i class="bi bi-recycle"></i>
                                            UPDATE</button>
                                        <button class="btn btn-outline-primary fw-bold generate" type="submit"
                                            data-bs-toggle="modal" data-bs-target="#generateaccess"
                                            form="generateaccess">
                                            Generate Access Token</button>
                                        <button class="btn btn-outline-primary fw-bold generate" type="submit"
                                            data-bs-toggle="modal" data-bs-target="#generatecurl" form="generatecurl">
                                            CURL to Generate Access Token</button>
                                        @else
                                        <button class="btn btn-outline-primary generate" type="submit"
                                            form="generatekey"><i class='bx bxs-key'></i>
                                            GENERATE KEY</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Sandbox OAuth2 Keys</h5>
                                <hr>
                                <div>
                                    <form class="row g-4"
                                        action="{{ isset($data->keyMappingId) ?  route('updategenerate') : route('oauthgenerate') }}"
                                        id="generatekey" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="SANDBOX">
                                        <input type="hidden" name="idmapping" value="{{ $data->keyMappingId ?? '' }}">
                                        <input type="hidden" name="keymanager" value="{{ $data->keyManager ?? '' }}">
                                        <input type="hidden" name="id" value="{{ $application->applicationId }}">
                                        @if (isset($data->consumerKey))
                                        <div class="col-sm-6">
                                            <h6>Consumer Key</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="text" class="form-control" name="consumerkey" id="consumerkey"
                                                    value="{{ $data->consumerKey ?? '' }}" placeholder="N/A" readonly>
                                                <div class="form-control-icon">
                                                    <i type="button" onclick="copyConsumerKey()"
                                                        class="bi bi-clipboard"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>Consumer Secret</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="password" class="form-control" name="secretkey" id="secretkey"
                                                    value="{{ $data->consumerSecret ?? '' }}" placeholder="N/A" readonly>
                                                <div class="form-control-icon">
                                                    <i type="button" id="toggle-secret-key" onclick="toggleSecretKey()"
                                                        class="bi bi-eye"></i>
                                                    <i type="button" onclick="copySecretKey()" class="bi bi-clipboard"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-md-12 infoconsumer">
                                            <p>Key and Secret <br>
                                                <mark class="text-danger"> Production Key and Secret is not
                                                    generated for this application</mark></p>
                                        </div>
                                        @endif
                                        <div class="col-sm-6">
                                            <h6>Token Endpoint</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="text" class="form-control" id="tokenendpoint"
                                                    name="tokenendpoint" value="{{ $url }}/oauth2/token" placeholder="N/A"
                                                    readonly>
                                                <div class="form-control-icon">
                                                    <i type="button" onclick="copyTokenEndpoint()"
                                                        class="bi bi-clipboard"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>Revoke Endpoint</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="text" class="form-control" id="revokeendpoint"
                                                    name="revokeendpoint" value="{{ $url }}/oauth2/revoke" placeholder="N/A"
                                                    readonly>
                                                <div class="form-control-icon">
                                                    <i type="button" onclick="copyRevokeEndpoint()"
                                                        class="bi bi-clipboard"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="GrantTypes" class="form-label fw-light">
                                                <small>
                                                    Grant Types :
                                                </small>
                                            </label>
                                            <div class="row">
                                                @foreach ($grant->grantTypes as $item)
                                                {{-- @if ($item == 'implicit')
                                                @continue
                                                @endif --}}
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="granttype[{{ $item }}]" role="switch"
                                                            {{ isset($data->supportedGrantTypes) ? (in_array($item,$data->supportedGrantTypes) ? 'checked':'') : '' }}
                                                            {{ isset($data->supportedGrantTypes) ? '' : (($item == 'password' || $item == 'client_credentials') ? 'checked':'') }}>
                                                        <label class="form-check-label">
                                                            @foreach ($granttype as $key=>$label)
                                                                @if ($key == $item)
                                                                {{  $label  }}
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <h6>Callback URL</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="url" class="form-control" name="callback" pattern="https?://.+"
                                                    value="{{ $data->callbackUrl ?? 'http://sample.com/callback/url' }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-link-45deg"></i>
                                                </div>
                                                <div id="callback" class="form-text">
                                                    <small>
                                                        Callback URL is a redirection URI
                                                        in the client application which is used by the authorization server
                                                        to send the client's user-agent (usually web browser) back after
                                                        granting access.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="GrantTypes" class="form-label fw-light">
                                                <small>
                                                    Scope :
                                                </small>
                                            </label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="scopetype[am_application_scope]" role="switch" checked>
                                                        <label class="form-check-label"
                                                            for="amapplication">am_application_scope</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="scopetype[default]" role="switch" checked>
                                                        <label class="form-check-label" for="default">Default</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>User Access Token Expiry Time</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="text" class="form-control" placeholder="N/A"
                                                    name="additional[user_access_token_expiry_time]"
                                                    value="{{ $data->additionalProperties->user_access_token_expiry_time ?? '' }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </div>
                                                <div id="useraccesstoken" class="form-text">
                                                    <small>
                                                        Type User Access Token Expiry Time.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>Refresh Token Expiry Time</h6>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="text" class="form-control" placeholder="N/A"
                                                    name="additional[refresh_token_expiry_time]"
                                                    value="{{ $data->additionalProperties->refresh_token_expiry_time ?? '' }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </div>
                                                <div id="refreshtoken" class="form-text">
                                                    <small>
                                                        Type Refresh Token Expiry Time.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider">
                        <div class="divider-text fw-bold bg-transparent">
                            <h3>API Keys Sandbox</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-none-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-none" type="button" role="tab" aria-controls="pills-none"
                                            aria-selected="true">None</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-http-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-http" type="button" role="tab" aria-controls="pills-http"
                                            aria-selected="false">IP Addresses</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-apiaddress-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-apiaddress" type="button" role="tab"
                                            aria-controls="pills-apiaddress" aria-selected="false">HTTP Referrers (Web
                                            Sites)</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-none" role="tabpanel"
                                        aria-labelledby="pills-none-tab" tabindex="0">
                                        @include('managekey.sandbox.none')
                                    </div>
                                    <div class="tab-pane fade" id="pills-http" role="tabpanel"
                                        aria-labelledby="pills-http-tab" tabindex="0">
                                        @include('managekey.sandbox.ipaddress')
                                    </div>
                                    <div class="tab-pane fade" id="pills-apiaddress" role="tabpanel"
                                        aria-labelledby="pills-apiaddress-tab" tabindex="0">
                                        @include('managekey.sandbox.http')
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


{{-- Modal --}}
<div class="modal fade" id="generatecurl" tabindex="-1" aria-labelledby="generatecurlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="generatecurlLabel">Get CURL to Generate Access Token</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>The following cURL command shows how to generate an access token using the Password Grant type.</p>
                <div id="oauth-basic">
                    curl -k -X POST {{ $url }}/oauth2/token -d "grant_type=password&username=Username&password=Password"
                    -H "Authorization: Basic <a id="userpasscurl" href="#">Base64(consumer-key:consumer-secret)</a>"
                </div>
                <p>In a similar manner, you can generate an access token using the Client Credentials grant type with
                    the following cURL command.</p>
                <div id="oauth-credentials">
                    curl -k -X POST {{ $url }}/oauth2/token -d "grant_type=client_credentials"
                    -H "Authorization: Basic <a id="credentialcurl" href="#">Base64(consumer-key:consumer-secret)</a>"
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="generateaccess" tabindex="-1" aria-labelledby="generateaccessLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="generateaccessLabel">Generate Access Token</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('accesstoken') }}" method="POST" id="form-accesstoken">
                    @csrf
                    <input type="hidden" name="consumersecretkey" value="{{ $data->consumerSecret ?? '' }}">
                    <input type="hidden" name="id" value="{{ $application->applicationId }}">
                    <input type="hidden" name="idmapping" value="{{ $data->keyMappingId ?? '' }}">
                </form>
                <div class="before-accesstoken">
                    <p class="fw-bold">Scopes</p>
                    <hr>
                    <p class="text-break">When you generate access tokens to APIs protected by scope/s, you can select
                        the scope/s and then generate the token for it. Scopes enable fine-grained access control to API
                        resources based on user roles. You define scopes to an API resource. When a user invokes the
                        API, his/her OAuth 2 bearer token cannot grant access to any API resource beyond its associated
                        scopes.</p>
                </div>
                <div class="result-accesstoken">
                    <h4>Please Copy the Access Token</h4>
                    <p>
                        If the token type is JWT or API Key, please copy this generated token value as it will be
                        displayed only for the current browser session. ( The token will not be visible in the UI after
                        the page is refreshed. )
                    </p>
                    <label for="text-accesstoken"></label>
                    <textarea name="token" id="text-accesstoken" cols="80" rows="7" disabled>
                </textarea>
                    <div class="my-2">
                        <button class="btn btn-success" onclick="myAccesstoken()">Copy To clipboard</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-accesstoken" form="form-accesstoken">

                    Generate
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="generateapikey" tabindex="-1" aria-labelledby="generateapikeyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="generateapikeyLabel">Generate API Key</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="before-apikeys">
                    <div class="form-check">
                        <form action="{{ route ('genapikey') }}" id="form-apikeys" method="POST">
                            @csrf
                            <input type="hidden" name="keytype" value="SANDBOX">
                            <input type="hidden" name="appid" value="{{ $application->applicationId }}">
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" name="infinitevalidity"
                                    id="infinitevalidity" checked>
                                <label class="form-check-label" for="infinitevalidity">
                                    API Key with infinite validity period
                                </label>
                            </div>
                            <div class="mb-3 periodapikey" style="display: none;">
                                <label for="exampleInputEmail1" class="form-label">
                                    <small>API Key validity period*</small>
                                </label>
                                <input type="number" class="form-control" id="validityPeriod" name="validityPeriod"
                                    aria-describedby="validityPeriod" placeholder="Enter time in seconds">
                                <div id="validityPeriod" class="form-text">You can set an expiration period to determine
                                    the validity period of the token after generation. Set this as -1 to ensure that the
                                    apikey never expires.</div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="result-apikeys">
                    <p>Please Copy the API Key
                        If the token type is JWT or API Key, please copy this generated token value as it will be
                        displayed only for the current browser session. ( The token will not be visible in the UI after
                        the page is refreshed. )</p>
                    <div>
                        <label for="text-apikey"></label>
                        <textarea name="token" id="text-apikey" cols="70" rows="10" disabled>
                        </textarea>
                    </div>
                    <div>
                        <small>Above token has a validity period of seconds.</small>
                    </div>
                    {{-- <button class="btn btn-success" onclick="copyApikey()">Copy To clipboard</button> --}}
                    <button class="btn btn-success" onClick="copyApikey()">Copy To clipboard</button>
                    {{-- <button onClick="copyApikey()">➡️ Copy Message to Clipboard</button> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-apikeys" form="form-apikeys">

                    Generate
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}

@push('script')
<script>

    const unsecuredCopyToClipboard = (text) => { 
        const textArea = document.createElement("textarea"); 
        textArea.value=text; 
        document.body.appendChild(textArea);                 
        textArea.focus();
        textArea.select(); 
        try
            {
            document.execCommand('copy')
            }catch(err){
                Swal.fire(
                'Error',
                '',
                'warning'
                )
            }
            document.body.removeChild(textArea)};

    const copyToClipboard = (content) => {
        if (window.isSecureContext && navigator.clipboard) {
            navigator.clipboard.writeText(content);
            Swal.fire(
            'Already Copied',
            '',
            'success'
            ) 
            console.log('Hellooo'); 
        } else {
            unsecuredCopyToClipboard(content);
            Swal.fire(
            'Already Copied',
            '',
            'success'
            )  
        }
    };
    var resultApikey = document.getElementById("text-apikey");
    const copyApikey = () => { 
        copyToClipboard(resultApikey.value);   
    };
    var consumerKey = document.getElementById("consumerkey");
    const copyConsumerKey = () => { 
        copyToClipboard(consumerKey.value);   
    };

    $(document).ready(function () {
        $('.result-accesstoken').hide();
    });

    const myModalEl = document.getElementById('generateaccess')
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $('.btn-accesstoken').show();
        $('.before-accesstoken').show();
        $('.result-accesstoken').hide();
    });

    $(document).on('submit', '#form-accesstoken', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $('.btn-accesstoken').html(`Loading`).attr(
                    'disabled', true);
            },
            success: function (data) {
                if (data.code != '900967') {
                    $('.before-accesstoken').hide();
                    $('.result-accesstoken').show();
                    $('#text-accesstoken').val(data.data.accessToken);
                    $('.btn-accesstoken').hide();
                    $('.btn-accesstoken').html(`Generate`)
                        .attr('disabled', false);
                } else {
                    Swal.fire(
                        'Error',
                        '',
                        'error'
                    )
                    $('.before-accesstoken').hide();
                    $('.result-accesstoken').show();
                    $('#text-accesstoken').val('Error please call developer for fix this!');
                    $('.btn-accesstoken').hide();
                    $('.btn-accesstoken').html(`Generate`)
                        .attr('disabled', false);
                }
            },
            error: function (data) {
                Swal.fire(
                    'Error',
                    '',
                    'warning'
                )
            }
        });
    });

    $('#credentialcurl').on('click', function (e) {
        e.preventDefault();
        if ($(this).html() == 'Base64(consumer-key:consumer-secret)') {
            $(this).html('{{ $base64 }}');
        } else {
            $(this).html('Base64(consumer-key:consumer-secret)');
        }
    });

    $('#userpasscurl').on('click', function (e) {
        e.preventDefault();
        if ($(this).html() == 'Base64(consumer-key:consumer-secret)') {
            $(this).html('{{ $base64 }}');
        } else {
            $(this).html('Base64(consumer-key:consumer-secret)');
        }
    });

    function copySecretKey() {
        var copyText = document.getElementById("secretkey");

        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        navigator.clipboard.writeText(copyText.value);

        Swal.fire(
            'Already Copied',
            '',
            'success'
        )
    }

    function toggleSecretKey() {
        var passwordField = document.getElementById("secretkey");
        var toggleBtn = document.getElementById("toggle-secret-key");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }

    function copyRevokeEndpoint() {
        var copyText = document.getElementById("revokeendpoint");

        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        navigator.clipboard.writeText(copyText.value);

        Swal.fire(
            'Already Copied',
            '',
            'success'
        )
    }

    function copyTokenEndpoint() {
        var copyText = document.getElementById("tokenendpoint");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(copyText.value);
        Swal.fire(
            'Already Copied',
            '',
            'success'
        )
    }

    function myAccesstoken() {
        var copyText = document.getElementById("text-accesstoken");

        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        navigator.clipboard.writeText(copyText.value);

        Swal.fire(
            'Already Copied',
            '',
            'success'
        )
    }

    $('#pills-none-tab').on('click',function(){
            reset();
        }); 
        $('#pills-apiaddress-tab').on('click',function(){
            reset();
        }); 
        $('#pills-http-tab').on('click',function(){
            reset();
        });
        $('#infinitevalidity').on('click',function(){
            resetvalidity();
        });

        function resetvalidity(){
            $('#validityPeriod').val('');
        }
        function reset(){
            $('.boxaddress').html('');
            $('#addip').val('');
            $('.boxhttp').html('');
            $('#addhttp').val('');
        }

        // API ADDRESS

        function isValidIPv6(ip) {
            let ipv6Pattern = /^s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]d|1dd|[1-9]?d)(.(25[0-5]|2[0-4]d|1dd|[1-9]?d)){3}))|:)))(%.+)?s*(\/([0-9]|[1-9][0-9]|1[0-1][0-9]|12[0-8]))?$/;
            return ipv6Pattern.test(ip);
        }

        function isValidIPv4(ip) {
            let ipv4Pattern = /^([0-9]{1,3}\.){3}[0-9]{1,3}(\/([0-9]|[1-2][0-9]|3[0-2]))?$/;
            return ipv4Pattern.test(ip);
        }

        $('.addip').on('click',function(e){
            e.preventDefault();
            let valip = $('.textaddress').val();
                if (valip == '') {
                    Swal.fire(
                        'Cannot be empty',
                        '',
                        'warning'
                    )
                }else if (!isValidIPv6(valip) && !isValidIPv4(valip)){
                    Swal.fire(
                        'Invalid IP address',
                        '',
                        'warning'
                    )
                }else{
                    $('.boxaddress').append(`<div class="col-3 deletboxipaddress my-3"><p class="fw-bold permitip">${valip}</p> <button class="btn btn-danger btn-sm deleteaddress"><i class="bi bi-trash2-fill"></i></button></div>`);
                    $('.textaddress').val('');
                }
        });
        
        $(document).on('click','.deleteaddress', function(){
            $(this).parents('.deletboxipaddress').remove();
        });

        // Array to string IPADDRESS
        function arraytostringip(ipaddresses){
            let ipaddress = '';
            ipaddresses.forEach((element,i) => {
                if(i > 0 ){
                    ipaddress += ',' + element;
                }else{
                    ipaddress = element;
                }
            });
            return ipaddress;
        }

        // HTTP REFERER
        $('.addhttp').on('click',function(){
            let valhttp = $('.texthttp').val();
            $('.boxhttp').append(`<div class="col-3 deletboxhttp"><p class="fw-bold permithttp">${valhttp}</p> <button class="btn btn-danger btn-sm deletehttp"><i class="bi bi-trash2-fill"></i></button></div>`);
            $('.texthttp').val('');
        });

        $(document).on('click','.deletehttp', function(){
            $(this).parents('.deletboxhttp').remove();
        });

        // Array to string HTTP REFERRER
        function arraytostringhttp(httpreferrers){
            let httpreferer = '';
            httpreferrers.forEach((element,i) => {
                if(i > 0 ){
                    httpreferer += ',' + element;
                }else{
                    httpreferer = element;
                }
            });
            return httpreferer;
        }

        // GENERATE APIKEY
        $("#infinitevalidity").change(function() {
            if($(this).prop('checked')) {
                $('.periodapikey').hide();
            } else {
                $('.periodapikey').show();
            }
        });

        $(document).ready(function() {
            $('.result-apikeys').hide();
        });
        
        const myModalApikey = document.getElementById('generateapikey')
        myModalApikey.addEventListener('hidden.bs.modal', event => {
            $('.btn-apikeys').show();
            $('.before-apikeys').show();
            $('.result-apikeys').hide();
        });

        $(document).on('submit','#form-apikeys', function(e){
            let httpreferrers = [];
            let ipaddresses = [];

            $('.permitip').each(function(i, obj) {
                ipaddresses.push($(this).html());
            });
            $('.permithttp').each(function(i, obj) {
                httpreferrers.push($(this).html());
            });
            
            let arripaddress = arraytostringip(ipaddresses);
            let arrhttpreferers = arraytostringhttp(httpreferrers);
            let formdata = new FormData(this);
            
            formdata.append('ipaddresses',arripaddress);
            formdata.append('httpreferrers',arrhttpreferers);

            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('.btn-apikeys').html(`<i class='bx bx-cog bx-spin'></i> Loading`).attr('disabled', true);
                },
                success: function(data) {
                    $('.before-apikeys').hide();
                    $('.result-apikeys').show();
                    $('#text-apikey').val(data.data.apikey);
                    $('#text-valitytime').val(data.data.validityTime);
                    $('.btn-apikeys').hide();
                    $('.btn-apikeys').html(`<i class='bx bx-cog bx-rotate-180'></i> Generate`).attr('disabled', false);
                }
            });
        });
</script>
@endpush

@endsection
