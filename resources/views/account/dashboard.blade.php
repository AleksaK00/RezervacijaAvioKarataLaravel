<x-accountlayout>

    <h1 class="text-center">Dashboard</h1>

    <div class="container-fluid p-1 mt-5">
        <div class="row g-3">

            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Korisničko ime: <span class="text-primary">{{ $korisnik['Korisnicko_Ime'] }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">email: <span class="text-primary">{{ $korisnik['Email'] }}</span></div>
            </div>
    
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Ime: <span class="text-primary">{{ $korisnik['Ime'] }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Prezime: <span class="text-primary">{{ $korisnik['Prezime'] }}</span></div>
            </div>

            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Adresa: <span class="text-primary">{{ $korisnik['Adresa'] }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Broj rezervacija: <span class="text-primary">{{ $brRezervacija }}</span></div>
            </div>
    
        </div>

        <div class="mt-5 text-end">
            <button class="btn btn-lg btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#potvrdaBrisanja">Obriši nalog</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="potvrdaBrisanja" tabindex="-1" aria-labelledby="potvrdaBrisanja" aria-hidden="true">
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
                        <a class="btn btn-danger" href="/account/delete">Obriši</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  
  
</x-accountlayout>