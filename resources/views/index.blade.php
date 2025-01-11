<x-layout>

    <section class="container">

        <div class = "row">

            <div class="col-md-12 mt-4">
                <h1 class="text-center display-5">Pretražite dostupne letove brzo i jednostavno!</h1>
            </div>

            <!-- Seachbar -->
            <x-searchbar/>

            {{--Ispis u slucaju da korisnik nije uneo destinaciju--}}
            <div class="row mt-3">
                @if($errors->any())
                    <div class="col-md-12 p-5 bg-white border border-primary rounded-4">
                        <p class="display-6 text-center">{{ $errors->first() }}</p>
                    </div> 
                @endif
            </div>
        </div>

    </section>

    <!-- Karusela i kartice sa promocijama, vidi promos.blade.php -->
    <x-promos :promocije="$promocije"/>

</x-layout>
