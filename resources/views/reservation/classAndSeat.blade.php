<x-layout>

    <section class="container">
        <div class="row mt-5 gx-4">       
            {{-- Navigaciona traka koja prikazuje korake rezervacije i omogucava vracanje nazad --}}
            <x-sideProgressBar brLeta="{{ $instancaLeta['Br_Leta'] }}" datumPolaska="{{ $instancaLeta['Datum_Polaska'] }}" klasa="" sediste="" korak="2"/>


            <div class="col-md-9 px-2 py-4 bg-white border border-primary rounded-4">

                <h3 class="text-center">Odaberi klasu</h3>

                <div class="row">

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

                @if($izabranaKlasa != "")

                    <div class="row border-top border-primary py-4 px-2 m-4">

                        <div class="col-md-8" data-cena = "{{ $instancaLeta['Cena_' . $izabranaKlasa] }}">
                            <form action="" method="POST">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <label for="brojKarata" class="lead">Izaberite broj Karata</label>
                                        <input class="form-control" type="number" id="brojKarata" name="brojKarata" min="1" max="5">
                                        <p class="display-6 mt-4">Cena: {{Number::currency($instancaLeta['Cena_' . $izabranaKlasa], in: 'EUR', locale: 'de')}}</p>
                                    </div>
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