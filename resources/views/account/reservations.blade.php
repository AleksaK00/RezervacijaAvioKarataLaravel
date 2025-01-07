<x-accountLayout>

    <h2 class="display-5 text-center">Istorija rezervacija</h2>

    {{-- Tabela koja ispisuje relevantne informacije o rezervaciji --}}
    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Avio Kompanija</th>
                    <th>Broj leta</th>
                    <th>Vreme Polaska</th>
                    <th>Datum Polaska</th>
                    <th>Polazni Aerodrom</th>
                    <th>Dolazni Aerodrom</th>
                    <th>Klasa</th>
                    <th>Cena</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($rezervacije as $rezervacija)
                    <tr>
                        <td>{{ $rezervacija['avioKompanija'] }}</td>
                        <td>{{ $rezervacija['Br_Leta'] }}</td>
                        <td>{{ $rezervacija['Vreme_Polaska'] }}</td>
                        <td>{{ $rezervacija['Datum_Polaska'] }}</td>
                        <td>{{ $rezervacija['PolazniAerodrom'] }}</td>
                        <td>{{ $rezervacija['DolazniAerodrom'] }}</td>
                        <td>{{ $rezervacija['Klasa'] }}</td>
                        <td>{{ Number::currency($rezervacija['Iznos'], in: 'EUR', locale: 'de') }}</td>
                        <td>
                            {{-- Ispisivanja statusa rezervacije --}}
                            @if ($rezervacija['Otkazana'] == 1)
                                <span class="text-danger"><b>Otkazana</b></span>
                            @elseif ($rezervacija['danaDo'] < 0)
                                <span class="text-success"><b>Ispunjena</b></span>
                            @elseif ($rezervacija['danaDo'] == 0)
                                <span class="text-info"><b>Danas! Srećan put</b></span>
                            @else
                                <span class="text-primary"><b>Za {{ floor($rezervacija['danaDo']) }} dana</b></span>
                            @endif
                        </td>
                        <td><button class="btn btn-secondary {{ ($rezervacija['Otkazana'] == 1 || $rezervacija['danaDo'] <= 0) ? 'disabled' : ''}}" type="button" data-bs-toggle="modal" data-bs-target="#potvrdaOtkazivanja" 
                            onclick="RezervacijaZaBrisanje('{{ $rezervacija['Br_Leta'] }}', '{{ $rezervacija['Datum_Polaska'] }}', '{{ $rezervacija['ID_Korisnika'] }}');">Otkaži</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal za potvrdu otkazivanja -->
    <div class="modal fade" id="potvrdaOtkazivanja" tabindex="-1" aria-labelledby="potvrdaOtkazivanja" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Potvrdi brisanje</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Da li ste sigurni da želite da obrišete nalog?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nazad</button>
                    <a class="btn btn-danger" href="" id="otkazi">Otkaži</a>
                </div>
            </div>
        </div>
    </div>
</x-accountLayout>