<x-adminLayout>
    
    <h2 class="display-5 text-center">Dashboard</h2>

    <div class="container-fluid p-1 mt-5">
        <div class="row g-3">

            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Ispunjenih rezervacija:<br> <span class="text-primary">{{ $brojIspunjenihRezervacija }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Rezervacije u toku:<br> <span class="text-primary">{{ $brojBuducihRezervacija }}</span></div>
            </div>

            <div class="col-md-12">
                Prihod se računa kao 10% od ukupnog iznosa rezervacije.
            </div>

            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Prihod do sada:<br> <span class="text-primary">{{ Number::currency($prihod, in: 'EUR', locale: 'de') }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Prihod neizvršenih rezervacija:<br> <span class="text-primary">{{ Number::currency($prihodNeizvrsenih, in: 'EUR', locale: 'de') }}</span></div>
            </div>

            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Klikova na promocije:<br> <span class="text-primary">{{ $brojKlikova }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="p-2 display-6 text-center border border-primary rounded-3">Broj rezervacija:<br> <span class="text-primary">6</span></div>
            </div>

        </div>
    </div>

    {{-- Grafikon(kanvas) sa očekivanim prihodom --}}
    <canvas id="dashboardChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($sledecaTriMeseca['mesec']),
                datasets: [{
                    label: 'Rezervacije',
                    data: @json($sledecaTriMeseca['ocekivaniPrihod']),
                    borderColor: '#ff6600',
                    backgroundColor: 'rgba(255,102,0,0.1)',
                }]
            }
        });
    </script>

</x-adminLayout>