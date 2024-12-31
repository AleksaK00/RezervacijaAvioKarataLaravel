<x-layoutLR>

    <!-- Forma za registraciju -->
    <section class="row justify-content-md-center">
        <div class="mt-4 p-5 bg-primary text-white rounded-4 col-md-3">
            <h2 class="text-center"><b>Registracija</b></h2>
            <form method="post" action="register.php" name="registrationForm">

                <div class="mb-3">
                    <label for="usernamePolje" class="form-label">Korisničko ime</label>
                    <input class="form-control" type="text" id="usernamePolje" name="userName">
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
                    <input id="lozinkaPotvrdaPolje" class="form-control" type="password" name="passwordConfirm" oninput="UporediSifru()" onfocus="UporediSifru()">
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

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary mb-3" name="registracija">Registruj se</button>
                </div>

                <!-- Obavestenje o greskama unosa -->

            </form>
        </div>
    </section>

</x-layoutLR>