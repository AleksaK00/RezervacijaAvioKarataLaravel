<x-layout>

    <section class="container">
        <div class="row mt-5 gx-4">       
            {{-- Navigaciona traka koja prikazuje korake rezervacije i omogucava vracanje nazad --}}
            <x-sideProgressBar brLeta="{{ $instancaLeta['Br_Leta'] }}" datumPolaska="{{ $instancaLeta['Datum_Polaska'] }}" klasa="" sediste="" korak="2"/>


            <div class="col-md-9 px-2 py-4 bg-white border border-primary rounded-4">

                {{-- Ispis dostupnih klasa, njihove cene i njihovih benefita --}}
                <h3 class="text-center">Odaberi klasu</h3>

                <div class="row">

                    {{-- Klase ispisane u infocard elementu, u linku salju izabranu klasu --}}
                    <x-infoCard class="col-md-4" image="site/economyLogo.png" altImage="Ekonomija logo" buttonText="Izaberi" destination="/reservation/{{ $instancaLeta['Br_Leta'] . '/' . $instancaLeta['Datum_Polaska'] . '/Ekonomija' }}" title="Ekonomija" isDisabled="false">
                        <div class="d-flex justify-content-center flex-column h-100">
                            <div class="">
                                <p>{!! nl2br($instancaLeta['Benefiti_Ekonomija']) !!}</p>
                            </div>                    
                            <div class="text-center mt-auto mb-3">
                                <h4 class="">{{ Number::currency($instancaLeta['Cena_Ekonomija'], in: 'EUR', locale: 'de') }}</h4>
                            </div>
                        </div>
                    </x-infoCard>

                    <x-infoCard class="col-md-4" image="site/premiumLogo.png" altImage="Premium ekonomija logo" buttonText="Izaberi" destination="/reservation/{{ $instancaLeta['Br_Leta'] . '/' . $instancaLeta['Datum_Polaska'] . '/Premium_Ekonomija' }}" title="Premium Ekonomija" isDisabled="{{$postoji['Premium_Ekonomija']}}">
                        <div class="d-flex justify-content-center flex-column h-100">
                            <div class="">
                                <p>{!! $instancaLeta['Cena_Premium_Ekonomija'] ? nl2br($instancaLeta['Benefiti_Premium_Ekonomija']) : '' !!}</p>
                            </div>                    
                            <div class="text-center mt-auto mb-3">
                                <h4 class="mt-auto">{{ $instancaLeta['Cena_Premium_Ekonomija'] ? Number::currency($instancaLeta['Cena_Ekonomija'], in: 'EUR', locale: 'de') : 'Nije Dostupno' }}</h4>
                            </div>
                        </div>                               
                    </x-infoCard>

                    <x-infoCard class="col-md-4" image="site/businessLogo.png" altImage="Biznis klasa logo" buttonText="Izaberi" destination="/reservation/{{ $instancaLeta['Br_Leta'] . '/' . $instancaLeta['Datum_Polaska'] . '/Biznis' }}" title="Biznis Klasa" isDisabled="{{$postoji['Biznis']}}">
                        <div class="d-flex justify-content-center flex-column h-100">
                            <div class="">
                                <p>{!! $instancaLeta['Cena_Biznis'] ? nl2br($instancaLeta['Benefiti_Biznis']) : '' !!}</p>
                            </div>                    
                            <div class="text-center mt-auto mb-3">
                                <h4 class="mt-auto">{{ $instancaLeta['Cena_Biznis'] ? Number::currency($instancaLeta['Cena_Biznis'], in: 'EUR', locale: 'de') : 'Nije Dostupno' }}</h4>
                            </div>
                        </div>
                    </x-infoCard>

                </div>

                {{-- Drugi odeljak ispisuje se iskljucivo ako je korisnik izabrao klasu --}}
                @if($izabranaKlasa != "")

                    <div class="row border-top border-primary py-4 px-2 m-4">

                        {{-- Korisnik bira broj karata, max 5, a zatim mu se prikazuje opcija za rezervaciju sedista, i to onoliko select-ova koliko je izabrao karata --}}
                        <div class="col-md-8 mt-5" id="odabir" data-Cena = "{{ $instancaLeta['Cena_' . $izabranaKlasa] }}">
                            <form action="" method="POST">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 text-center">

                                        <label for="brojKarata" class="lead">Izaberite broj Karata</label>
                                        <input class="form-control w-50 ms-auto me-auto" type="number" id="brojKarata" name="brojKarata" value="1" min="1" max="5" onchange="IzracunajCenu(); PrikaziRezervacijuSedista();">
                                        <p class="display-6 mt-4" id="ispisCene">Cena: {{Number::currency($instancaLeta['Cena_' . $izabranaKlasa], in: 'EUR', locale: 'de')}}</p>

                                        <div class="border-top border-primary p-3 mt-5">

                                            @for($i = 1; $i <= 5; $i++)

                                                <div class="row mb-3" id="sediste{{ $i }}div"  style="{{ $i == 1 ? '' : 'display: none;'}}">
                                                    <div class="col-md-8">
                                                        <h4>Rezervišite sedište{{ $i == 1 ? '' : ' karte ' . $i }}:</h4>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-select" id="sediste{{ $i }}" name="sediste{{ $i}}" onchange="IzracunajDoplatu(); OnemoguciDupliOdabir();">
                                                            <option value="" data-Doplata="0">Ne rezevišem</option>
                                                            @foreach($sedista as $sediste)
                                                                <option value="{{ $sediste['Br_Sedista'] }}" data-Doplata="{{ $sediste['Doplata'] }}">{{ $sediste['Br_Sedista'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            @endfor

                                            <h4 class="display-6 mt-5" id="doplataSedista"></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="row tex-center">
                                    @csrf
                                    <input type="submit" class="btn btn-secondary btn-lg mt-5" value="Izaberi">
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <img src="{{ asset('images/SeatConfigurations/' . $instancaLeta['ICAO_Kod'] . $avion['Model'] . '.png') }}"/>
                        </div>

                    </div>

                @endif

            </div> 
        </div>
    </section>

</x-layout>