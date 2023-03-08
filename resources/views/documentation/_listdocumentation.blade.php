
<div class="fw-bold mb-3">
    <h6><i class="bi bi-list"></i> Document List:</h6>
    <hr>
</div>

@foreach ($data as $items => $item )
<div>
    <p class="fw-bold"><i class="bi bi-journal"></i> {{$items}}</p>
    <div class="ps-4">
        @foreach ($item as $child)
        <a type="submit" id="btn-detail-document"
        data-api-id="{{ $api_id }}" data-document-id="{{ $child->documentId }}" data-sourcetype="{{ $child->sourceType }}" data-summary="{{ $child->summary }}">
            <p>{{ $child->name }}</p>
        </a>
        @endforeach
    </div>
</div>
@endforeach