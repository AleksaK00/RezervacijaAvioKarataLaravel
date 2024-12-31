@props(['goToPage', 'clickableText'])

<section class="row justify-content-md-center">
    <div class="mt-4 pt-5 ps-5 pe-5 pb-2 bg-primary text-white rounded-4 col-md-4">
        <h2 class="text-center"><b>{{ $slot }}</b></h2>
        <div class="text-center"><a class="btn btn-primary mb-3 mt-3" href="{{ $goToPage }}">{{ $clickableText }}</a></div>
    </div>
</section>