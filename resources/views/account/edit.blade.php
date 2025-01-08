<x-accountLayout>

    {{-- Ispisivanje gresaka unosa --}}
    @if($errors->any())          
        <div class="text-bg-danger text-center mb-2 p-2 rounded-4">
            {{ $errors->first() }}
        </div>   
    @endif
    
    {{-- Izmena osnovnih informacija --}}
    <div class="row">
        <fieldset class="col-md-12 px-4 py-4 bg-white border border-primary rounded-4">
            <legend class="display-6 ms-auto me-auto">Informacije o nalogu</legend>

            <div class="container-fluid p-1 mt-2">
                <div class="row g-2">

                    <div class="col-md-6">
                        <div class="pt-3 px-3 bg-white border border-primary rounded-4 fs-4 h-100">
                            <div class="row mb-3">
                                <div class="col-md-6">Korisničko ime:</div>
                                <div class="col-md-6 text-primary">{{ $korisnik['Korisnicko_Ime'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">email:</div>
                                <div class="col-md-6 text-primary">{{ $korisnik['Email'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-center mt-3"><button class="btn btn-secondary btn-lg" onclick="PrikaziIzmeneOsnovnih();">Izmeni</button></div>
                            </div>
                        </div>
                    </div>

                    {{-- Prikazuje se kada korisnik pritisne izmeni --}}
                    <div class="col-md-6">
                        <form action="/account/edit/base" method="POST">
                            @csrf
                            <div class="pt-3 px-3 bg-white border border-primary rounded-4 fs-4 h-100" id="izmenaOsnovnih" style="display: none;">
                                <div class="row mb-3">
                                    <div class="col-md-6">Korisničko ime:</div>
                                    <div class="col-md-6"><input type="text" name="username" class="form-control" value="{{ $korisnik['Korisnicko_Ime']}}"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">email:</div>
                                    <div class="col-md-6"><input type="text" name="email" class="form-control" value="{{ $korisnik['Email']}}"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="button" class="btn btn-secondary btn-lg mx-3" onclick="SakrijIzmeneOsnovnih();">Otkaži</button>
                                        <input type="submit" class="btn btn-secondary btn-lg mx-3" value="Potvrdi">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>

    {{-- Izmena licnih informacija --}}
    <div class="row">
        <fieldset class="col-md-12 px-4 py-4 bg-white border border-primary rounded-4">
            <legend class="display-6 ms-auto me-auto">Lične informacije</legend>

            <div class="container-fluid p-1 mt-2">
                <div class="row g-2">

                    <div class="col-md-6">
                        <div class="pt-3 px-3 bg-white border border-primary rounded-4 fs-4 h-100">
                            <div class="row mb-3">
                                <div class="col-md-6">Ime:</div>
                                <div class="col-md-6 text-primary">{{ $korisnik['Ime'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">Prezime:</div>
                                <div class="col-md-6 text-primary">{{ $korisnik['Prezime'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">Adresa:</div>
                                <div class="col-md-6 text-primary">{{ $korisnik['Adresa'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-center mt-3"><button class="btn btn-secondary btn-lg" onclick="PrikaziIzmeneLicnih();">Izmeni</button></div>
                            </div>
                        </div>
                    </div>

                    {{-- Prikazuje se kada korisnik pritisne izmeni --}}
                    <div class="col-md-6">
                        <form action="/account/edit/personal" method="POST">
                            @csrf
                            <div class="pt-3 px-3 bg-white border border-primary rounded-4 fs-4 h-100" id="izmenaLicnih" style="display: none;">
                                <div class="row mb-3">
                                    <div class="col-md-6">Korisničko ime:</div>
                                    <div class="col-md-6"><input type="text" name="name" class="form-control" value="{{ $korisnik['Ime']}}"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">email:</div>
                                    <div class="col-md-6"><input type="text" name="surname" class="form-control" value="{{ $korisnik['Prezime']}}"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">Adresa:</div>
                                    <div class="col-md-6"><input type="text" name="address" class="form-control" value="{{ $korisnik['Adresa']}}"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="button" class="btn btn-secondary btn-lg mx-3" onclick="SakrijIzmeneLicnih();">Otkaži</button>
                                        <input type="submit" class="btn btn-secondary btn-lg mx-3" value="Potvrdi">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>

    <div class="row">
        <fieldset class="col-md-12 px-4 py-4 bg-white border border-primary rounded-4">
            <legend class="display-6 ms-auto me-auto">Izmena lozinke</legend>
            <h3 class="text-center">Da bi ste izmenili lozinku, zatražite kod za potvrdu promene</h3>


                <form method="POST" action="/account/edit/password">
                    @csrf
                    <div class="row p-3">
                        <div class="col-md-6">
                            <input type="password" name="resetCode" class="form-control" placeholder="Unesite kod za potvrdu">
                        </div>
                        <div class="col-md-6 text-center">
                            <input type="submit" name="resetujSifru" class="btn btn-secondary btn-lg mx-3" value="Potvrdi kod">
                            <a class="btn btn-secondary btn-lg mx-3" href="/account/edit/resetRequest">Zatraži kod</a>
                        </div>
                    </div>
                </form>

        </fieldset>
    </div>

</x-accountLayout>