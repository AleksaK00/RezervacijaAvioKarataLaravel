<x-accountLayout>
    <h2 class="display-6 text-center">Promena šifre</h2>

    <form action="/account/edit/password/change" method="post" name="registrationForm">
        @csrf
        <div class="row mb-3 justify-content-center">
            <div class="col-md-3" id="lozinkaDiv">
                <label for="lozinkaPolje" class="form-label">Lozinka</label>
                <input id="lozinkaPolje" class="form-control" type="password" name="password" oninput="KvalitetSifre()" onfocus="KvalitetSifre()">
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-md-3" id="lozinkaPotvrdaDiv">
                <label for="lozinkaPotvrdaPolje" class="form-label">Potvrdi Lozinku</label>
                <input id="lozinkaPotvrdaPolje" class="form-control" type="password" name="password_confirm" oninput="UporediSifru()" onfocus="UporediSifru()">
            </div>
        </div>

        <div class="row mb-3 text-center justify-content-center">
            <div class="col-md-3">
                <input class="btn btn-secondary btn-lg" type="submit" name="potvrdi" value="Promeni šifru">
            </div>
        </div>
    </form>

    <!-- Obavestenje o greskama unosa -->
    @if($errors->any())          
        <div class="text-bg-danger text-center mb-2 p-2 rounded-4">
            {{ $errors->first() }}
        </div>   
    @endif
    
</x-accountLayout>