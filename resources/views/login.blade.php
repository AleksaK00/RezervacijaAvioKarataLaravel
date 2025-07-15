<x-layoutLR> 
    
    <!-- Forma za Log in -->
    <section class="row justify-content-md-center">

        <div class="mt-5 p-5 bg-primary text-white rounded-4 col-md-3">
            <h2 class="text-center"><b>Prijava</b></h2>
            <form method="post" action="/login">

            <div class="mb-3">
                <label for="usernamePolje" class="form-label">Korisničko ime:</label>
                <input class="form-control" type="text" id="usernamePolje" name="username">
            </div>

            <div class="mb-3">
                <label for="LozinkaPolje" class="form-label">Lozinka</label>
                <input id="lozinkaPolje" class="form-control" type="password" name="password">
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                @csrf
                <button type="submit" class="btn btn-primary mb-3" name="prijava">Prijavite se</button>
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
</x-layoutLR>