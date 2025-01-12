<x-adminLayout>
    <h2 class="display-6 text-center">Upravljanje promocijama</h2>

    {{-- Ispisivanje gresaka unosa --}}
    @if($errors->any())          
        <div class="text-bg-danger text-center mt-2 mb-2 p-2 rounded-4">
            {{ $errors->first() }}
        </div>   
    @endif

    {{-- Ispis Promocija --}}
    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">

            <tr>
                <th>ID</th>
                <th>Destinacija</th>
                <th>Tekst</th>
                <th>Aktivan slot</th>
                <th></th>
            </tr>

            @foreach($promocije as $promocija)

                <tr>
                    <td>{{ $promocija['ID'] }}</td>
                    <td>{{ $promocija['Destinacija'] }}</td>
                    <td>{{ $promocija['Tekst'] }}</td>
                    <td>{{ $promocija['Aktivan_Slot'] }}</td>
                    <td>
                        {{-- Dugme za brisanje promocije uz potvrdu iz modala --}}
                        <button class="btn btn-secondary {{ $promocija['Aktivan_Slot'] > 0 ? 'disabled' : ''}}" type="button" data-bs-toggle="modal" data-bs-target="#potvrdaBrisanja" 
                        onclick="PromocijaZaBrisanje('{{ $promocija['ID'] }}');">Obriši</button>
                    </td>
                </tr>

            @endforeach

        </table>
    </div>

    {{-- Forma za promenu aktivnog slota --}}
    <div class="row">
        <fieldset class="col-md-12 px-4 py-2 bg-white border border-primary rounded-4">
            <legend class="display-6 ms-auto me-auto">Aktivne promocije</legend>

            <form method="POST" action="/admin/promos/change">
                @csrf
                <div class="container-fluid p-1 mt-5">
                    <div class="row g-3">

                        {{-- Slot 1 --}}
                        <div class="col-md-4">
                            <div class="border border-primary p-4 my-3 rounded-4">
                                <h3 class="text-center">Slot 1</h3>

                                <select name="slot1Select" id="slot1Select" class="form-control">
                                    <option value="0">Ne aktivan</option>
                                    @foreach($promocije as $promocija)
                                        <option value="{{$promocija['ID']}}" {{($promocija['Aktivan_Slot'] == 1)? 'selected' : ''}}>{{ $promocija['Destinacija'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Slot 2 --}}
                        <div class="col-md-4">
                            <div class="border border-primary p-4 my-3 rounded-4">
                                <h3 class="text-center">Slot 2</h3>

                                <select name="slot2Select" id="slot2Select" class="form-control">
                                    <option value="0">Ne aktivan</option>
                                    @foreach($promocije as $promocija)
                                        <option value="{{$promocija['ID']}}" {{($promocija['Aktivan_Slot'] == 2)? 'selected' : ''}}>{{ $promocija['Destinacija'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Slot 3 --}}
                        <div class="col-md-4">
                            <div class="border border-primary p-4 my-3 rounded-4">
                                <h3 class="text-center">Slot 3</h3>

                                <select name="slot3Select" id="slot3Select" class="form-control">
                                    <option value="0">Ne aktivan</option>
                                    @foreach($promocije as $promocija)
                                        <option value="{{$promocija['ID']}}" {{($promocija['Aktivan_Slot'] == 3)? 'selected' : ''}}>{{ $promocija['Destinacija'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row my-3 justify-content-center">
                        <input type="submit" value="Promeni" class="btn btn-lg btn-secondary w-25">
                    </div>
                </div>
            </form>
        </fieldset>
    </div>

    {{-- Forma za ubacivanje nove promocije --}}
    <div class="row">
        <fieldset class="col-md-12 px-4 py-2 bg-white border border-primary rounded-4">
            <legend class="display-6 ms-auto me-auto">Nova Promocija</legend>

            <form method="POST" action="/admin/promos/new" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center p-3">
                    <div class="col-md-4">

                        <div class="mb-3 text-center">
                            <label for="slikaUnos" class="form-label">Unesi sliku, JPG, 16:9, minimum 1080p</label>
                            <input class="form-control" type="file" id="slikaUnos" name="slikaUnos">
                        </div>

                        <div class="mb-3 text-center">
                            <label for="destinacijaUnos" class="form-label">Destinacija</label>
                            <input class="form-control" type="text" id="destinacijaUnos" name="destinacijaUnos">
                        </div>

                        <div class="mb-3 text-center">
                            <label for="tekstUnos" class="form-label">Promocioni tekst</label>
                            <textarea class="form-control" id="tekstUnos" name="tekstUnos" rows="3"></textarea>
                        </div>
                          
                        <div class="mb-3 text-center">
                            <input type="submit" value="Unesi" class="btn btn-lg btn-secondary w-25">
                        </div>
                    </div>
                </div>
            </form>

        </fieldset>
    </div>

    <!-- Modal za potvrdu otkazivanja -->
    <div class="modal fade" id="potvrdaBrisanja" tabindex="-1" aria-labelledby="potvrdaBrisanja" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Potvrdi brisanje</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Da li ste sigurni da želite da obrišete promociju?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nazad</button>
                    <a class="btn btn-danger" href="" id="dugmeModal">Obriši</a>
                </div>
            </div>
        </div>
    </div>

</x-adminLayout>