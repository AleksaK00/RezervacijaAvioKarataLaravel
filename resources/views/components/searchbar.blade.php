<div class="navbar bg-primary col-md-12 mt-2">

    <div class="container-fluid justify-content-center">
        <form class="d-flex" method="post" action="/search" name="formaPretraga" id="formaPretraga">
            @csrf
            <input class="form-control me-2" name="polazniAerodrom" type="search" placeholder="Polazni aerodrom" aria-label="PolazniAerodrom">
            <input class="form-control me-2" name="dolazniAerodrom" type="search" placeholder="Dolazni aerodrom" aria-label="DolazniAerodrom">
            <button type="submit" class="btn btn-primary" name="pretraga">Pretraži</button>
        </form>
    </div>
</div>
