@props(['image', 'altImage', 'title', 'destination', 'buttonText', 'isDisabled'])

{{-- Template za karticu, ako je izabrano disabled koristi se 'greyed-out' template posle elsa --}}
@if ($isDisabled == 'false')
    <div {{ $attributes }}>
        <div class="card border-primary h-100">
            <img src="{{ asset('images/' . $image) }}" class="card-img-top" alt="{{ $altImage }}">
            <div class="card-body text-center">
                <h5 class="card-title">{{ $title }}</h5>
                {{ $slot }}
            </div>
            <div class="d-flex align-items-end mb-3 justify-content-center">
                <a href="{{ $destination }}" class="btn btn-secondary btn-lg">{{ $buttonText }}</a>
            </div>
        </div>
    </div>   
@else
    <div {{ $attributes }}>
        <div class="card border-secondary h-100">
            <img src="{{ asset('images/' . $image) }}" class="card-img-top" alt="{{ $altImage }}">
            <div class="card-body text-center">
                <h5 class="card-title">{{ $title }}</h5>
                {{ $slot }}
            </div>
            <div class="d-flex align-items-end mb-3 justify-content-center">
                <button class="btn btn-secondary btn-lg" disabled>{{ $buttonText }}</button>
            </div>
        </div>
    </div>
@endif   