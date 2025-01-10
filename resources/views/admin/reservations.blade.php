<x-adminLayout>
    <x-adminSearchBar akcija="/admin/reservations" />
    
    {{-- Ispisivanje gresaka unosa --}}
    @if($errors->any())          
        <div class="text-bg-danger text-center mt-2 mb-2 p-2 rounded-4">
            {{ $errors->first() }}
        </div>   
    @endif
    
    {{-- Ispis Rezervacija --}}
    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">

            <tr>
                <th>Korisnicko ime</th>
                <th>Broj Leta</th>
                <th>Datum</th>
                <th>Broj karata</th>
                <th>Klasa</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Adresa</th>
                <th>Status</th>
                <th></th>
            </tr>

            @foreach($rezervacije as $rezervacija)
                <tr>
                    <td>{{ $rezervacija['KorisnickoIme'] }}</td>
                    <td>{{ $rezervacija['Br_Leta'] }}</td>
                    <td>{{ $rezervacija['Datum_Polaska'] }}</td>
                    <td>{{ $rezervacija['Br_Karata'] }}</td>
                    <td>{{ $rezervacija['Klasa'] }}</td>
                    <td>{{ $rezervacija['Ime'] }}</td>
                    <td>{{ $rezervacija['Prezime'] }}</td>
                    <td>{{ $rezervacija['Adresa'] }}</td>
                    <td>
                        {{-- Ispisivanja statusa rezervacije --}}
                        @if ($rezervacija['Otkazana'] == 1)
                            <span class="text-danger"><b>Otkazana</b></span>
                        @elseif ($rezervacija['danaDo'] < 0)
                            <span class="text-success"><b>Ispunjena</b></span>
                        @elseif ($rezervacija['danaDo'] == 0)
                            <span class="text-info"><b>Danas</b></span>
                        @else
                            <span class="text-primary"><b>Za {{ floor($rezervacija['danaDo']) }} dana</b></span>
                        @endif        
                    </td>
                    <td><button class="btn btn-secondary {{ ($rezervacija['Otkazana'] == 1 || $rezervacija['danaDo'] <= 0) ? 'disabled' : ''}}" type="button" data-bs-toggle="modal" data-bs-target="#potvrdaOtkazivanja" 
                        onclick="RezervacijaZaBrisanje('{{ $rezervacija['Br_Leta'] }}', '{{ $rezervacija['Datum_Polaska'] }}', '{{ $rezervacija['ID_Korisnika'] }}');">Otkaži</button></td>
                </tr>
            @endforeach            
        </table>
    </div>
    {{-- Paginacija --}}
    {{$rezervacije->links()}}
    
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
</x-adminLayout>