<x-layout>

    <section class="container">
        <div class="row mt-5 gx-4">    
            {{-- Navigaciona traka koja prikazuje korake rezervacije i omogucava vracanje nazad --}}   
            <x-sideProgressBar brLeta="{{ $brLeta }}" datumPolaska="" klasa="" sediste="" korak="1"/>


            {{-- Polje sa tabelama za prikaz dostupnih datuma za let i cenom klasa --}}
            <div class="col-md-9 px-5 py-4 bg-white border border-primary rounded-4">

                <h3 class="text-center">Dostupni letovi kompanije <b class="text-primary">{{ $avioKompanija['Ime']}}</b> za let <b class="text-primary">{{ $letovi[0]['Br_Leta'] }}</b></h3>

                <div class="table-responsive mt-4">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Datum Polaska</th>
                                <th>Ekonomija</th>
                                <th>Premium ekonomija</th>
                                <th>Biznis</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($letovi as $let)
                                <tr>
                                    <td>{{ $let['Datum_Polaska'] }}</td>
                                    <td>{{ Number::currency($let['Cena_Ekonomija'], in: 'EUR', locale: 'de') }}</td>
                                    <td>{{ $let['Cena_Premium_Ekonomija'] ? Number::currency($let['Cena_Premium_Ekonomija'], in: 'EUR', locale: 'de') : 'Nije Dostupna' }}</td>
                                    <td>{{ $let['Cena_Biznis'] ? Number::currency($let['Cena_Biznis'], in: 'EUR', locale: 'de') : 'Nije Dostupna' }}</td>
                                    <td><a href="{{ $let['Br_Leta'] }}/{{ $let['Datum_Polaska'] }}" class="btn btn-secondary btn-md">Izaberi</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- forma sa kolacicima o pretrazenoj destinaciji, vraca na pretragu --}}
                    <div class="text-center"> 
                        <form method="post" action="/search">
                            @csrf
                            <input type="hidden" value="{{Request::cookie('polazniGrad')}}" name="polazniAerodrom"/>
                            <input type="hidden" value="{{Request::cookie('dolazniGrad')}}" name="dolazniAerodrom"/>
                            <input type="submit" value="Nazad" class="btn btn-secondary btn-lg mt-1"/>
                        </form>
                    </div>

                </div>
            </div> 
        </div>
    </section>

</x-layout>