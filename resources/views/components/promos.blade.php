<article class="container mt-2 mb-5">

    <!-- Karusela sa 3 razlicite ponude linija, na klik pretrazuje sve letove promovisane rute -->
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div id="carouselExampleCaptions" class="carousel slide">

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">

                    <!-- Onclick akcije popunjavaju search formu i pretrazuju letove Beograd - Pritisnuti grad -->
                    <div class="carousel-item active">
                        <img src="{{ asset('images/Promo/Rim.jpg') }}" class="d-block w-100" alt="Slika Rima" onclick="PretragaPromo('formaCarousel1')">
                        <div class="carousel-captionTopText d-none d-md-block">
                            <h4 onclick="PretragaPromo('formaCarousel1')">Beograd - Rim</h4>
                            <p onclick="PretragaPromo('formaCarousel1')">Pogledajte naše ponude letova za srce Italije.</p>
                            <form method="post" action="" name="formaCarousel1">
                                @csrf
                                <input type="hidden" name="polazniAerodrom" value="Beograd">
                                <input type="hidden" name="dolazniAerodrom" value="Rim">
                            </form>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset('images/Promo/Istanbul.jpg') }}" class="d-block w-100" alt="Slika Istanbula" onclick="PretragaPromo('formaCarousel2')">
                        <div class="carousel-caption d-none d-md-block">
                            <h4 onclick="PretragaPromo('formaCarousel2')">Beograd - Istanbul</h4>
                            <p onclick="PretragaPromo('formaCarousel2')">Pogledajte naše ponude letova za most izmedju Evrope i Azije.</p>
                            <form method="post" action="" name="formaCarousel2">
                                @csrf
                                <input type="hidden" name="polazniAerodrom" value="Beograd">
                                <input type="hidden" name="dolazniAerodrom" value="Istanbul">
                            </form>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset('images/Promo/London.jpg') }}" class="d-block w-100" alt="Slika Londona" onclick="PretragaPromo('formaCarousel3')">
                        <div class="carousel-caption d-none d-md-block">
                            <h4 onclick="PretragaPromo('formaCarousel3')">Beograd - London</h4>
                            <p onclick="PretragaPromo('formaCarousel3')">Pogledajte naše ponude letova za London.</p>
                            <form method="post" action="" name="formaCarousel3">
                                @csrf
                                <input type="hidden" name="polazniAerodrom" value="Beograd">
                                <input type="hidden" name="dolazniAerodrom" value="London">
                            </form>
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </div>
    </div>

</article>

<!-- Kartice sa 4 promocije avio kompanija, klikom na dugme ide se na rezervaciju sa prosledjenim primarnim kljucem promovisanog leta -->
<article class="container mt-5 mb-5 px-2">
    <div class="row gx-2">

        <div class="col-md-3">
            <div class="card border-primary">
                <img src="{{ asset('images/AirlineLogos/ASL.png') }}" class="card-img-top" alt="Air Serbia logo">
                <div class="card-body text-center">
                    <h5 class="card-title">Air Serbia promo</h5>
                    <p class="card-text">Rezervišite jedan od promocionih letova Air Srbije za Rim. Ne propustite ponudu!</p>
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="brLeta" value="JU400">
                        <input type="hidden" name="ICAOkod" value="ASL">
                        <input type="submit" name="izaberi" class="btn btn-secondary btn-lg mt-3" value="Rezerviši">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-primary">
                <img src="{{ asset('images/AirlineLogos/WZZ.png') }}" class="card-img-top" alt="Air Serbia logo">
                <div class="card-body text-center">
                    <h5 class="card-title">Air Serbia promo</h5>
                    <p class="card-text">Rezervišite jedan od promocionih letova Air Srbije za Rim. Ne propustite ponudu!</p>
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="brLeta" value="JU400">
                        <input type="hidden" name="ICAOkod" value="ASL">
                        <input type="submit" name="izaberi" class="btn btn-secondary btn-lg mt-3" value="Rezerviši">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-primary">
                <img src="{{ asset('images/AirlineLogos/ASL.png') }}" class="card-img-top" alt="Air Serbia logo">
                <div class="card-body text-center">
                    <h5 class="card-title">Air Serbia promo</h5>
                    <p class="card-text">Rezervišite jedan od promocionih letova Air Srbije za Rim. Ne propustite ponudu!</p>
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="brLeta" value="JU400">
                        <input type="hidden" name="ICAOkod" value="ASL">
                        <input type="submit" name="izaberi" class="btn btn-secondary btn-lg mt-3" value="Rezerviši">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-primary">
                <img src="{{ asset('images/AirlineLogos/WZZ.png') }}" class="card-img-top" alt="Air Serbia logo">
                <div class="card-body text-center">
                    <h5 class="card-title">Air Serbia promo</h5>
                    <p class="card-text">Rezervišite jedan od promocionih letova Air Srbije za Rim. Ne propustite ponudu!</p>
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="brLeta" value="JU400">
                        <input type="hidden" name="ICAOkod" value="ASL">
                        <input type="submit" name="izaberi" class="btn btn-secondary btn-lg mt-3" value="Rezerviši">
                    </form>
                </div>
            </div>
        </div>

    </div>
</article>
