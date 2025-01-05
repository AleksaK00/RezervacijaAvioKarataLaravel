@props(['brLeta', 'datumPolaska', 'klasa', 'korak'])

<div class="col-md-3">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav flex-column w-100">
                    <li class="nav-item">
                        <a 
                            class="nav-link fs-4 {{ Request::is('reservation/' . $brLeta) ? 'rounded-3 active' : ''}}" 
                            href="/reservation/{{ $brLeta }}">Datum polaska</a>
                    </li>
                    <li class="nav-item">
                        <a 
                            class="nav-link fs-4 {{ (Request::is('reservation/' . $brLeta . '/' . $datumPolaska) || Request::is('reservation/' . $brLeta . '/' . $datumPolaska . '/' . $klasa)) ? 'rounded-3 active' : ''}}
                            {{ ($korak < 2) ? 'disabled' : ''}}"
                            href="/reservation/{{ $brLeta }}/{{ $datumPolaska}}">Klasa i sedište</a>
                    </li>
                    <li class="nav-item">
                        <a 
                            class="nav-link fs-4 {{ Request::is('reservation/' . $brLeta . '/' . $datumPolaska . '/' . $klasa . '/info') ? 'rounded-3 active' : ''}}
                            {{ ($korak < 3) ? 'disabled' : ''}}" 
                            href="/reservation/{{ $brLeta }}/{{ $datumPolaska}}/{{ $klasa . '/info'}}">Unos informacija</a>
                    </li>
                    <li class="nav-item">
                        <div 
                            class="nav-link fs-4 {{ Request::is('reservation/' . $brLeta . '/' . $datumPolaska . '/' . $klasa . '/confirm') ? 'rounded-3 active' : ''}}
                            {{ ($korak < 4) ? 'disabled' : ''}}"
                             >Potvrda</div>
                    </li>
                </ul>
            </div>
        </div>
</div>