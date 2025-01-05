<x-layout>

    <section class="container">
        <div class="row mt-5 gx-4">  

            {{-- Navigaciona traka koja prikazuje korake rezervacije i omogucava vracanje nazad --}}
            <x-sideProgressBar brLeta="{{ $brLeta }}" datumPolaska="{{ $datumPolaska }}" klasa="{{ $klasa }}" korak="3"/>

            <div class="col-md-9 px-2 py-4 bg-white border border-primary rounded-4">

                <h3 class="text-center">Unesi/Potvrdi informacije</h3>

                <div class="row justify-content-center">
                    <div class="col-md-6"> 

                        <form action="/reservation/{{ $brLeta }}/{{ $datumPolaska }}/{{ $klasa }}/confirm" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="brKarata" value="{{ $brojKarata }}">
                            <input type="hidden" name="izabranasedista" value="{{ json_encode($izabranaSedista) }}"> --}}
                            <div class="mb-3">
                              <label for="ime" class="form-label">Ime</label>
                              <input type="text" class="form-control" id="ime" name="ime" value="{{ $korisnik['Ime'] }}">
                            </div>
                            <div class="mb-3">
                              <label for="prezime" class="form-label">Prezime</label>
                              <input type="text" class="form-control" id="prezime" name="prezime" value="{{ $korisnik['Prezime'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="adresa" class="form-label">Prezime</label>
                                <input type="text" class="form-control" id="adresa" name="adresa" value="{{ $korisnik['Adresa'] }}">
                              </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary btn-lg mt-3 mb-3">Potvrdi</button>
                            </div>
                          </form>

                          <!-- Obavestenje o greskama unosa -->
                            @if($errors->any())          
                                <div class="text-bg-danger text-center mb-2 p-2 rounded-4">
                                    {{ $errors->first() }}
                                </div>   
                            @endif
                    </div>
                </div>

            </div>

        </div>
    </section>

</x-layout>