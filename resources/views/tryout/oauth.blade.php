<div class="row">
    <div class="col-12 col-lg-6">
        <div class="mb-3">
                <h6>Access Token :</h6>
                <div class="form-group position-relative has-icon-right">
                    <input type="password" class="form-control generatetestkey" placeholder="Authorization Bearer" id="accesstoken-oauth"
                    aria-label="authorizationbearer" aria-describedby="authorizationbearer">
                    <div class="form-control-icon">
                        <i id="toggle-accesstoken-oauth" onclick="toggleOauth()" class="bi bi-eye"></i>
                    </div>
                </div>
                {{-- <div id="authorizationbearer" class="form-text">Enter access Token.</div> --}}
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-generate-test-key" type="submit" form="form-oauth-generate-test-key">
                Generate Test Key
            </button>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <form class="row" action="{{ route ('generatetestkeyoauth') }}" method="POST" id="form-oauth-generate-test-key">
            @csrf
            <input type="hidden" name="security" id="oauth" value="oauth">
            <input type="hidden" name="applicationid" value="{{ $application->applicationId }}">
            <input type="hidden" name="sandboxmappingid" value="{{ $sandbox->keyMappingId ?? ''}}">
            <input type="hidden" name="sandboxconsumersecret" value="{{ $sandbox->consumerSecret ?? ''}}">
            <input type="hidden" name="productionmappingid" value="{{ $production->keyMappingId ?? ''}}">
            <input type="hidden" name="productionconsumersecret" value="{{ $production->consumerSecret ?? ''}}">
            <div class="col-6 my-1">
                <p class="fw-bold">Keytype</p>
                <hr>
                <div class="form-check form-check-inline">
                    <input class="form-check-input check-oauth" type="radio" name="keytype" id="inlineRadio1"
                        value="SANDBOX" checked>
                    <label class="form-check-label" for="inlineRadio1">Sandbox</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input check-oauth" type="radio" name="keytype" id="inlineRadio2"
                        value="PRODUCTION">
                    <label class="form-check-label" for="inlineRadio2">Production</label>
                </div>
            </div>
            <div class="col-6 my-1">
                <p class="fw-bold">GATEWAY</p>
                <hr>
                <div>
                    <select class="form-select" aria-label="gateway" name="gateway">
                        <option>-- API Gateways --</option>
                        <option value="default" selected>Default</option>
                    </select>
                    <div id="gateway" class="form-text">
                        Please select an environment            
                    </div>
                </div>
            </div>
            <div class="col-6 mt-2">
                <p class="fw-bold">API</p>
                <hr>
                <div>
                    <select class="form-select" aria-label="api" name="api">
                        <option>-- Select API --</option>
                        @foreach ($subscription->list as $items)
                        <option value="{{ $items->apiInfo->name }}" data-toggle="tooltip" data-placement="top"
                          title="{{ $items->apiInfo->description}} ">
                          {{ $items->apiInfo->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div> 
</div>

@push('script')
    <script>
        function resetoauth(){
            $('#accesstoken-oauth').val('');
        }

        $('.check-oauth').on('click',function(){
            resetoauth();
        });

        $(document).on('submit','#form-oauth-generate-test-key', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('.btn-generate-test-key').html(`<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>`).attr('disabled', true);
                },
                success: function(data) {
                    if (data.data != null) {
                        $('#accesstoken-oauth').val(data.data.accessToken);
                        $('.btn-generate-test-key').html(`Generate Test Key`).attr('disabled', false);
                    } else {
                        setTimeout(location.reload.bind(location), 1000);
                    }
                },
                error: function(){

                }
            });
        });
    </script>
@endpush
