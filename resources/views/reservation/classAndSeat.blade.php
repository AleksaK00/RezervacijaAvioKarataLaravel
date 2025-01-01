<x-layout>

    <section class="container">
        <div class="row mt-5 gx-4">       
            <x-sideProgressBar brLeta="{{ $brLeta }}" datumPolaska="{{ $datumPolaska }}" klasa="" sediste="" korak="2"/>


            <div class="col-md-9 px-5 py-4 bg-white border border-primary rounded-4">

                <h3 class="text-center">Odabir klase za let <b>{{ $brLeta }}</b> koji se odrzava {{ $datumPolaska }}<b></b></h3>

            </div> 
        </div>
    </section>

</x-layout>