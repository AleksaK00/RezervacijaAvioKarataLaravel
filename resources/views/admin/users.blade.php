<x-adminLayout>
    
    {{-- Searchbar --}}
    <x-adminSearchBar akcija="/admin/users" />

    {{-- Ispisivanje gresaka unosa --}}
    @if($errors->any())          
        <div class="text-bg-danger text-center mt-2 mb-2 p-2 rounded-4">
            {{ $errors->first() }}
        </div>   
    @endif
    
    {{-- Ispis Korisnika --}}
    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">

            <tr>
                <th>ID</th>
                <th>Korisnicko ime</th>
                <th></th>
                <th>email</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Adresa</th>
                <th></th>
                <th></th>
            </tr>

            @foreach($korisnici as $korisnik)
                <tr>
                    <td>{{ $korisnik['ID_Korisnika'] }}</td>
                    <td>
                        <span id="korisnickoIme{{ $korisnik['ID_Korisnika'] }}" style="display: inline;">{{ $korisnik['Korisnicko_Ime']}}</span>
                        <form method="POST" action="/admin/changename/{{ $korisnik['ID_Korisnika'] }}">
                            @csrf
                            <span id="poljeNovoKorisnickoIme{{ $korisnik['ID_Korisnika'] }}" style="display: none;">
                                <input type="text" class="form-control" name="novoKorisnickoIme{{ $korisnik['ID_Korisnika'] }}">
                                <input type="submit" class="btn btn-sm btn-secondary text-center" value="Potvrdi">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="OtkaziIzmenu('{{ $korisnik['ID_Korisnika'] }}');">Otkaži</button>
                            </span>
                        </form>
                    </td>
                    <td><button class="btn btn-secondary ms-1" type="button" onclick="PrikaziIzmenu('{{ $korisnik['ID_Korisnika'] }}');">Izmeni</button></td>
                    <td>{{ $korisnik['Email']}}</td>
                    <td>{{ $korisnik['Ime']}}</td>
                    <td>{{ $korisnik['Prezime']}}</td>
                    <td>{{ $korisnik['Adresa']}}</td>
                    {{-- Gasenje naloga dostupno ako nije ugasen, vracanje ako jeste, koristi modal za potvrdu --}}
                    <td>
                        @if($korisnik['Is_Deleted'] != 1)
                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#potvrda" 
                                onclick="KorisnikZaGasenje('{{ $korisnik['ID_Korisnika'] }}');">Ugasi</button>                      
                        @else
                            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#potvrda" 
                                onclick="KorisnikZaVracanje('{{ $korisnik['ID_Korisnika'] }}');">Vrati</button> 
                        @endif
                    </td>
                    <td><button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#potvrda" 
                            onclick="KorisnikZaBrisanje('{{ $korisnik['ID_Korisnika'] }}');">Obriši</button></td>
                </tr>
            @endforeach            
        </table>
    </div>
    {{-- Paginacija --}}
    {{$korisnici->links()}}
    
    {{-- Modal, link zavisi od pritisnutog dugmeta --}}
    <div class="modal fade" id="potvrda" tabindex="-1" aria-labelledby="potvrda" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Potvrdi brisanje</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalText">
                    Da li ste sigurni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nazad</button>
                    <a class="btn btn-danger" href="" id="dugmeModal"></a>
                </div>
            </div>
        </div>
    </div>
</x-adminLayout>