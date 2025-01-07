<x-accountLayout>

    <h2 class="display-5 text-center">Istorija rezervacija</h2>

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
                        <td><a class="btn btn-secondary btn-md" href="/reservation/{{ $rezervacija['Br_Leta'] }}/{{ $rezervacija['Datum_Polaska'] }}/{{ $rezervacija['ID_Korisnika'] }}/cancel">Otkaži</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-accountLayout>