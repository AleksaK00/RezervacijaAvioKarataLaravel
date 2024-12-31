<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{'css/stil1.css'}}"  rel="stylesheet">
</head>
<body>
    <main class="container-fluid d-flex flex-column min-vh-100">

        {{-- Header sa logom kompanije i kontrolama koje se menjaju u zavisnosti da li je korisnik ulogovan. --}}
        <header class="navbar navbar-expand-lg bg-primary">

            <div class="container-fluid">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/site/ikona.png') }}" alt="logo kompanije"> REZERVACIJA AVIONSKIH KARATA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Nazad</a>
                        </li>
                    </ul>
                </div>
            </div>

        </header>

        {{-- Sadrzaj strane --}}
        {{ $slot }}

        <footer class="container-fluid mt-auto">

            <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-2 border-top">
                <p class="col-md-4 mb-0 text-body-dark">© 2024 Rezervacija avionskih karata</p>

                <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="/" class="px-2 link-dark link-underline-opacity-0 link-underline-opacity-75-hover">Početna</a></li>
                    <li class="nav-item"><a href="#" class="px-2 link-dark link-underline-opacity-0 link-underline-opacity-75-hover">FAQ</a></li> <!-- Implementiraj FAQ stranicu -->
                    <li class="nav-item"><a href="#" class="px-2 link-dark link-underline-opacity-0 link-underline-opacity-75-hover">O nama</a></li> <!-- Implementiraj About stranicu -->
                </ul>
            </div>

        </footer>
    </main>

    {{-- JavaScript skripte --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @if (Request::path() == 'register')
        <script src="{{ asset('js/formValidation.js') }}"></script>
    @endif
</body>
</html>
