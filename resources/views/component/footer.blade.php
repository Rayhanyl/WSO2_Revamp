

        <footer>
            {{-- <div class="container">
                <div class="footer clearfix mb-0 text-muted" style="margin-top:150px;">
                    <div class="float-start">
                        <h3>Asabri</h3>
                        <p>
                            Menara ASABRI,Grand Indonesia,JL. MH Thamrin No.1<br>
                            Jakarta 10310, INA<br>
                            <strong>Phone:</strong> (021) 765 3421<br>
                        </p>
                        <p>2023 &copy; Swamedia Informatika</p>
                    </div>
                    <div class="float-end">
                        &copy; Copyright <strong><span>PT ASABRI</span></strong>. All Rights Reserved
                    </div>
                </div>
            </div> --}}
            <div class="col-12 text-light bg-primary bg-gradient" style="margin-top:120px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 p-3">
                            <h3 class="text-light">Asabri</h3>
                            <p>
                                Menara ASABRI,Grand Indonesia,JL. MH Thamrin No.1<br>
                                Jakarta 10310, INA<br>
                                <strong>Phone:</strong> (021) 765 3421<br>
                            </p>
                            <p>2023 &copy; Swamedia Informatika</p>
                        </div>
                        <div class="col-12 col-lg-6 p-3 row">
                            <div class="col-12">
                                <div class="img-footer text-lg-end text-sm-start">
                                    <img class="img-thumbnail rounded" width="350" height="120" src="{{ asset ('assets/images/logo/asabri.png')}}" alt="Image Footer">
                                </div>
                            </div>
                            <div class="col-12 text-lg-end text-sm-start">
                                &copy; Copyright <strong><span>PT ASABRI</span></strong>. All Rights Reserved
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{asset ('assets/js/jquery-3.6.1.js')}}" ></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{asset ('assets/aos/aos.js')}}"></script>
<script src="{{asset ('assets/js/bootstrap.js')}}"></script>
<script src="{{asset ('assets/js/app.js')}}"></script>
<script src="{{asset ('assets/js/pages/horizontal-layout.js')}}"></script>
<script src="{{asset ('assets/js/pages/dashboard.js')}}"></script>
<script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-bundle.js" crossorigin></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="{{ asset ('assets/showdown/showdown.min.js') }}"></script>
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    AOS.init();

    $('.reset-local-storage').on('click',function(){
        localStorage.removeItem('jsonapiswagger');
        localStorage.removeItem('jsonapiswagger2');
        localStorage.removeItem('jsonapiswagger3');
        localStorage.removeItem('access_token_parshing');
    });
</script>
@stack('script')
</body>
</html>