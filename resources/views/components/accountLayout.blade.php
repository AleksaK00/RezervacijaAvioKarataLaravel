<x-layout>

    <section class="container">
        
        <div class="row mt-5">

            <nav class="navbar navbar-expand-lg bg-primary">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 lead">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('account/dashboard') ? 'active rounded-3' : ''}}" href="/account/dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('account/reservations') ? 'active rounded-3' : ''}}" href="/account/reservations">Rezervacije</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('account/edit') ? 'active rounded-3' : ''}}" href="/account/edit">Izmeni informacije</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
                
        </div>

        <div class="row mt-3">
            <div class="col-md-12 px-4 py-4 bg-white border border-primary rounded-4">
                {{ $slot }}
            </div>
        </div>

    </section>

</x-layout>