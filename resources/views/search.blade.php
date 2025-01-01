<x-layout>

    <section class="container">

        <div class = "row">

            <div class="col-md-12 mt-4">
                <h1 class="text-center display-5">Pretražite dostupne letove brzo i jednostavno!</h1>
            </div>

            <!-- Seachbar -->
            <x-searchbar/>

        </div>

        <div class="row mt-3">
            {{--Ispis u slucaju da nisu pronadjeni letovi--}}
            @if(count($pretraga->rezultatNiz) == 0)

                <div class="col-md-12 p-5 bg-white border border-primary rounded-4">
                    <p class="display-6 text-center">Nema dostupnih letova između dva tražena grada!</p>
                </div> 
            @else

                <!-- Kreiranje div-a sa filterima upisanim u podaciZaFilter -->
                <div class="col-md-12 p-3 bg-white border border-primary rounded-4 mb-4">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h3 class="text-center">Filteri</h3>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-secondary d-flex ms-auto" onclick="ResetujFiltere(); Filter(); SliderIspis()">Reset</button>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Filter za avio kompanije -->
                        <div class="col-md-3 form-group text-center">
                            <form name="formaFilterAvioKompanija" id="formaFilterAvioKompanija">
                            <label for="filterAvioKompanije" class="form-label lead">Avio kompanija:</label>
                            <select id="filterAvioKompanije" name="filterAvioKompanije" class="form-select text-center border border-primary" onchange="Filter()">
                                <option value="">Sve</option>
                                @foreach ($pretraga->podaciZaFilter['avioKompanije'] as $ICAOkod => $imeKompanije)
                                    <option value="{{ $ICAOkod }}">{{ $imeKompanije }}</option>
                                @endforeach
                            </select>
                            </form>
                        </div>

                        <!-- Filter za polazni aerodrom -->
                        <div class="col-md-3 form-group text-center">
                            <form name="formaFilterPolazniAerodrom" id="formaFilterPolazniAerodrom">
                                <label for="filterPolazniAerodrom" class="form-label lead">Polazni aerodrom:</label>
                                <select id="filterPolazniAerodrom" name="filterPolazniAerodrom" class="form-select text-center border border-primary" onchange="Filter()">
                                    <option value="">Svi</option>
                                    @foreach ($pretraga->podaciZaFilter['polazniAerodromi'] as $aerodrom)
                                        <option value="{{ $aerodrom }}">{{ $aerodrom }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <!-- Filter za dolazni aerodrom -->
                        <div class="col-md-3 form-group text-center">
                            <form name="formaFilterDolazniAerodrom" id="formaFilterDolazniAerodrom">
                                <label for="filterDolazniAerodrom" class="form-label lead">Dolazni aerodrom:</label>
                                <select id="filterDolazniAerodrom" name="filterDolazniAerodrom" class="form-select text-center border border-primary" onchange="Filter()">
                                    <option value="">Svi</option>
                                    @foreach ($pretraga->podaciZaFilter['dolazniAerodromi'] as $aerodrom)
                                        <option value="{{ $aerodrom }}">{{ $aerodrom }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <!-- Filter za cenu -->
                        <div class="col-md-3 form-group text-center">
                            <form name="formaFilterCena" id="formaFilterCena">
                                <label id="labelaFilterCena" for="filterCena" class="form-label lead">Cena do:</label>
                                <input name="filterCena" id="filterCena" type="range" class="form-range" min="{{ $pretraga->podaciZaFilter['minCena'] }}"
                                       max="{{ $pretraga->podaciZaFilter['maxCena'] + 1 }}" onchange="Filter(); SliderIspis()"
                                       value="{{ $pretraga->podaciZaFilter['maxCena'] + 1 }}">
                            </form>
                        </div>

                    </div>
                </div>

                <!-- Ispis svake pretrage u card komponenti bootstrapa -->
                @foreach($pretraga->rezultatNiz as $rezultat)

                    <div class="card mb-3 rounded-4 border-primary resultcard" data-AvioKompanija="{{ $rezultat->avioKompanija['ICAO_Kod'] }}" data-PolazniAerodrom="{{ $rezultat->polazniAerodrom['Ime'] }}"
                         data-DolazniAerodrom="{{ $rezultat->dolazniAerodrom['Ime'] }}" data-Cena="{{ $rezultat->CenaOd() }}">
                        <div class="row g-0">

                            <div class="col-md-2">
                                <img src="IMAGES/AirlineLogos/{{ $rezultat->avioKompanija['ICAO_Kod'] }}.png" class="img-fluid rounded-start" alt="{{ $rezultat->avioKompanija['Ime'] }} logo">
                            </div>

                            <div class="col-md-10">

                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $rezultat->polazniAerodrom['Grad'] . ' - ' . $rezultat->dolazniAerodrom['Grad'] }}</h3>
                                    <br>
                                    <p class="card-text text-center">Kompanija: <b>{{ $rezultat->avioKompanija['Ime'] }}</b>. Broj Leta: {{ $rezultat->let['Br_Leta'] }}. <b>{{ $rezultat->polazniAerodrom['Ime'] . ' - ' . $rezultat->dolazniAerodrom['Ime'] }}</b></p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="card-text display-5 mt-3">OD: {{ Number::currency($rezultat->CenaOd(), in: 'EUR', locale: 'de') }}</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-text display-5 mt-3">{{ date("H:i", strtotime($rezultat->let['Vreme_Polaska'] ))}} h</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <!-- link koji prosledjuje broj leta stranici za rezervaciju -->
                                            <a href="reservation/{{ $rezultat->let['Br_Leta'] }}" class="btn btn-secondary btn-lg mt-3">Rezerviši</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach

            @endif


        </div>

    </section>

    <!-- Karusela i kartice sa promocijama, vidi promos.blade.php -->
    <x-promos></x-promos>

</x-layout>
