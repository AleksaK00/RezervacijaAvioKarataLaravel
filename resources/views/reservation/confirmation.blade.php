<x-layout>

    <section class="container">

        <div class="row mt-5 gx-4">  

            {{-- Navigaciona traka koja prikazuje korake rezervacije i omogucava vracanje nazad --}}
            <x-sideProgressBar brLeta="{{ $instancaLeta['Br_Leta'] }}" datumPolaska="{{ $instancaLeta['Datum_Polaska'] }}" klasa="{{ $klasa }}" korak="4"/>

            <div class="col-md-9 px-4 py-4 bg-white border border-primary rounded-4">

                <h3 class="text-center">Pregled Rezervacije</h3>

                {{-- Ispis bitnih podataka o rezervaciji u tabeli --}}
                <div class="table-responsive">
                    <table class="table mt-3 display-6">
                        <tr>
                            <td class="text-primary">Avio Kompanija:</td>
                            <td>{{ $avioKompanija['Ime'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Broj Leta:</td>
                            <td>{{ $instancaLeta['Br_Leta'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Datum Polaska:</td>
                            <td>{{ $instancaLeta['Datum_Polaska'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Klasa:</td>
                            <td>{{ $klasa }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Broj karata:</td>
                            <td>{{ Request::session()->get('brojKarata') }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Cena: </td>
                            <td>{{ Number::currency((Request::session()->get('cenaKarte') * Request::session()->get('brojKarata')), in: 'EUR', locale: 'de')  }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Izabrana Sedista: </td>
                            <td>
                                @foreach (Request::session()->get('izabranaSedista') as $sediste)
                                    @if ($sediste != "")
                                        {{ $sediste . ' ' }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="text-primary">Cena Doplate: </td>
                            <td>{{ Number::currency(Request::session()->get('cenaDoplate'), in: 'EUR', locale: 'de') }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Ime: </td>
                            <td>{{ $informacije['Ime'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Prezime: </td>
                            <td>{{ $informacije['Prezime'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Adresa: </td>
                            <td>{{ $informacije['Adresa'] }}</td>
                        </tr>
                    </table>

                    {{-- Ispis ukupne cene --}}
                    <h3 class="display-5 text-center mt-5">Ukupno: {{ Number::currency((Request::session()->get('cenaKarte') * Request::session()->get('brojKarata') + Request::session()->get('cenaDoplate')), in: 'EUR', locale: 'de') }}</h3>
                </div>

                {{-- Forma sa hidden inputima koje sadrze informacije potrebne za tabale rezervacije, naloga, i rezervisanih sedista uz one koje se nalaze u sesiji --}}
                <div class="text-center">
                    <form method="post" action="/reservation/{{ $instancaLeta['Br_Leta'] }}/{{ $instancaLeta['Datum_Polaska'] }}/{{ $klasa }}/confirmed">
                        @csrf
                        <input type="hidden" name="brLeta" value="{{ $instancaLeta['Br_Leta'] }}">
                        <input type="hidden" name="datumPolaska" value="{{ $instancaLeta['Datum_Polaska'] }}">
                        <input type="hidden" name="ICAO_Kod" value="{{ $instancaLeta['ICAO_Kod'] }}">
                        <input type="hidden" name="klasa" value="{{ $klasa }}">
                        <input type="hidden" name="ime" value="{{ $informacije['Ime'] }}">
                        <input type="hidden" name="prezime" value="{{ $informacije['Prezime'] }}">
                        <input type="hidden" name="adresa" value="{{ $informacije['Adresa'] }}">
                        <input type="hidden" name="registracija" value={{ $instancaLeta['Registracija'] }}>
                        <input type="submit" class="btn btn-secondary btn-lg mt-5" name="rezervisi" value="Rezerviši let">
                    </form>
                </div>
    
            </div>
        </div>
    </section>
</x-layout>