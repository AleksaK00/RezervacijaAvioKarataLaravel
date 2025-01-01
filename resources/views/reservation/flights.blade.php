<x-layout>

    <section class="container">
        <div class="row mt-5 gx-4">       
            <div class="col-md-3">
                <nav class="navbar navbar-expand-lg bg-primary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="nav flex-column w-100">
                                <li class="nav-item">
                                    <a class="nav-link active rounded-3 fs-4" aria-current="page" href="#">Datum polaska</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-4" href="">Klasa i sedište</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-4" href="">Unos informacija</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-4" href="">Potvrda</a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>

            <div class="col-md-9 p-5 bg-white border border-primary rounded-4">

                <h3 class="text-center">Dostupni letovi kompanije <b class="text-primary">{{ $avioKompanija['Ime']}}</b> za let <b  class="text-primary">{{ $letovi[0]['Br_Leta'] }}</b></h3>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Datum Polaska</th>
                                <th>Ekonomija</th>
                                <th>Premium ekonomija</th>
                                <th>Biznis</th>
                                <th>Prva klasa</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($letovi as $let)
                                <tr>
                                    <td>{{ $let['Datum_Polaska'] }}</td>
                                    <td>{{ $let['Cena_Ekonomija'] . ' €' }}</td>
                                    <td>{{ $let['Cena_Premium_Ekonomija'] ? $let['Cena_Premium_Ekonomija'] . ' €' : 'Nije Dostupna' }}</td>
                                    <td>{{ $let['Cena_Biznis'] ? $let['Cena_Biznis'] . ' €' : 'Nije Dostupna' }}</td>
                                    <td>{{ $let['Cena_Prva'] ? $let['Cena_Prva'] . ' €' : 'Nije Dostupna' }}</td>
                                    <td><a href="reservation/class/{{ $let['Br_Leta'] }}/{{ $let['Datum_Polaska'] }}" class="btn btn-secondary btn-md">Izaberi</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div> 
        </div>
    </section>

</x-layout>