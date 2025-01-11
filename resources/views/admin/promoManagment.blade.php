<x-adminLayout>
    <h2 class="display-6 text-center">Upravljanje promocijama</h2>

    {{-- Ispis Promocija --}}
    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">

            <tr>
                <th>ID</th>
                <th>Destinacija</th>
                <th>Tekst</th>
                <th>Aktivan slot</th>
            </tr>

            @foreach($promocije as $promocija)

                <tr>
                    <td>{{ $promocija['ID'] }}</td>
                    <td>{{ $promocija['Destinacija'] }}</td>
                    <td>{{ $promocija['Tekst'] }}</td>
                    <td>{{ $promocija['Aktivan_Slot'] }}</td>
                </tr>

            @endforeach

        </table>
    </div>

    {{-- Forma za promenu aktivnog slota --}}
    <div class="row">
        <fieldset class="col-md-12 px-4 py-2 bg-white border border-primary rounded-4">
            <legend class="display-6 ms-auto me-auto">Aktivne promocije</legend>

            <form>
                <div class="container-fluid p-1 mt-5">
                    <div class="row g-3">

                        {{-- Slot 1 --}}
                        <div class="col-md-4">
                            <div class="border border-primary p-4 my-3 rounded-4">
                                <h3 class="text-center">Slot 1</h3>

                                <select name="slot1select" id="slot1select" class="form-control">
                                    <option value="0">Ne aktivan</option>
                                    @foreach($promocije as $promocija)
                                        <option value="{{$promocija['ID']}}" {{($promocija['Aktivan_Slot'] == 1)? 'selected' : ''}}>{{ $promocija['Destinacija'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Slot 1 --}}
                        <div class="col-md-4">
                            <div class="border border-primary p-4 my-3 rounded-4">
                                <h3 class="text-center">Slot 2</h3>

                                <select name="slot1select" id="slot1select" class="form-control">
                                    <option value="0">Ne aktivan</option>
                                    @foreach($promocije as $promocija)
                                        <option value="{{$promocija['ID']}}" {{($promocija['Aktivan_Slot'] == 2)? 'selected' : ''}}>{{ $promocija['Destinacija'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Slot 1 --}}
                        <div class="col-md-4">
                            <div class="border border-primary p-4 my-3 rounded-4">
                                <h3 class="text-center">Slot 3</h3>

                                <select name="slot1select" id="slot1select" class="form-control">
                                    <option value="0">Ne aktivan</option>
                                    @foreach($promocije as $promocija)
                                        <option value="{{$promocija['ID']}}" {{($promocija['Aktivan_Slot'] == 3)? 'selected' : ''}}>{{ $promocija['Destinacija'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </fieldset>
    </div>

</x-adminLayout>