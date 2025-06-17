<x-adminLayout>

    <!-- Forma za registraciju -->
    <section class="row justify-content-md-center">
        <div class="mt-4 p-5 bg-primary text-white rounded-4 col-md-5">
            <h2 class="text-center"><b>Novi korisnik</b></h2>
            <form method="post" action="/admin/noviKorisnik" name="registrationForm">

                <div class="mb-3">
                    <label for="usernamePolje" class="form-label">Korisničko ime</label>
                    <input class="form-control" type="text" id="usernamePolje" name="username">
                </div>

                <div class="mb-3">
                    <label for="emailPolje" class="form-label">eMail</label>
                    <input class="form-control" type="email" id="emailPolje" name="email">
                </div>

                <div class="mb-3" id="lozinkaDiv">
                    <label for="lozinkaPolje" class="form-label">Lozinka</label>
                    <input id="lozinkaPolje" class="form-control" type="password" name="password" oninput="KvalitetSifre()" onfocus="KvalitetSifre()">
                </div>

                <div class="mb-3" id="lozinkaPotvrdaDiv">
                    <label for="lozinkaPotvrdaPolje" class="form-label">Potvrdi Lozinku</label>
                    <input id="lozinkaPotvrdaPolje" class="form-control" type="password" name="password_confirm" oninput="UporediSifru()" onfocus="UporediSifru()">
                </div>

                <div class="mb-3">
                    <label for="imePolje" class="form-label">Ime</label>
                    <input class="form-control" type="text" id="imePolje" name="name">
                </div>

                <div class="mb-3">
                    <label for="prezimePolje" class="form-label">Prezime</label>
                    <input class="form-control" type="text" id="prezimePolje" name="surname">
                </div>

                <div class="mb-3">
                    <label for="adresaPolje" class="form-label">Adresa</label>
                    <input class="form-control" type="text" id="adresaPolje" name="adress">
                </div>

                <div class="mb-3">
                    <label for="ulogaPolje" class="form-label">Uloga</label>
                    <select class="form-select" id="ulogaPolje" name="role">
                        <option value="KORISNIK">Korisnik</option>
                        <option value="ADMIN">Administrator</option>
                        <option value="MENADZER">Menadžer</option>
                    </select>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-3" name="registracija">Dodaj korisnika</button>
                </div>

                <!-- Obavestenje o greskama unosa -->
                @if($errors->any())          
                    <div class="text-bg-danger text-center mb-2 p-2 rounded-4">
                         {{ $errors->first() }}
                    </div>   
                 @endif

            </form>
        </div>
    </section>

</x-adminLayout>