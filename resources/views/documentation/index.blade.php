@extends('app')
@section('content')
<style>
    .vl {
        border-left: 0.3em solid rgb(0, 102, 244);
        min-height: 200px;

    }
    </style>
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Documentation API <i class="bi bi-file-earmark-text-fill"></i></h3>
        <hr>
    </div>
    <div class="page-content mb-4">
        <section id="application">
                <div class="row">
                    <div class="col-12 col-lg-3 list-documentation">
                        <div class="select-api">
                            <h5>Select API :</h5>
                            <form action="#" method="GET">
                                <select class="form-select" aria-label="List API Documentation" name="api-id" id="api-id" required>
                                    <option selected>-- Select --</option>
                                    @foreach ($listapipublish as $items)
                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                    @endforeach
                                </select>
                                <div class="d-grid gap-2 my-2">
                                    <button class="btn btn-primary btn-sm rounded-pill" type="submit" id="find-document">Find Documentation API <i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="list-documentation-api my-4">
                            <div class="overflow-auto" style="max-height:500px;">
                                <div class="d-flex justify-content-center" id="loader">
                                </div>
                                <div class="content-documentation" id="content-documentation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="overflow-auto" style="max-height:700px;">
                            <div id="document-result">
    
                            </div>
                            <div class="d-flex justify-content-center" id="loader2">
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>

@push('script')
    <script>

        $(document).on('click', '#find-document', function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: '{{ route('listdocumentation') }}',
                dataType: 'html',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_api: $('#api-id').val(),
                },
                beforeSend: function() {
                    $('#content-documentation').html('');
                    $('#document-result').html('');
                    $('#loader').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');

                },
                success: function(data) {
                    $('#content-documentation').html(data);
                },
                complete: function() {
                    $('#loader').html('');

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                    $('#content-documentation').html(pesan);
                },
            });
        });

        $(document).on('click', '#btn-detail-document', function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: '{{ route('resultdocumentation') }}',
                dataType: 'html',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_api: $(this).data('api-id'),
                    id_document: $(this).data('document-id'),
                    sourcetype: $(this).data('sourcetype'),
                    summary: $(this).data('summary'),
                },
                beforeSend: function() {
                    $('#document-result').html('');
                    $('#loader2').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
                },
                success: function(data) {
                    $('#document-result').html(data);
                    const typesource = $('#data-typesource').html();
                    if(typesource == 'FILE'){
                        const JsonData = $('#data-json').html();
                        const FileJson = JSON.stringify(JsonData);

                        function download(content, fileName, contentType) {
                            const a = document.createElement("a");
                            const file = new Blob([content], { type: contentType });
                            a.href = URL.createObjectURL(file);
                            a.download = fileName;
                            a.click();
                        }

                        const button = document.getElementById("download-file");
                        button.addEventListener("click", function() {
                            download(JSON.parse(FileJson), "ENROLLMENT-AAS.postman_collection_viaWSO2.json", "text/plain");
                        });
                    }else if(typesource == "MARKDOWN"){
                        const markdownText = $('#data-markdown').html();
                        const converter = new showdown.Converter();
                        const htmlText = converter.makeHtml(markdownText);
                            document.getElementById("markdown-content").innerHTML = htmlText;
                    }
                },
                complete: function() {
                    $('#loader2').html('');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                    $('#document-result').html(pesan);
                },
            });
        });
    </script>
@endpush
@endsection