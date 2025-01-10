@props(['akcija'])

<div class="navbar bg-primary col-md-12 mt-1">

    <div class="container-fluid">
        <form class="d-flex" method="post" action="{{$akcija}}" name="formaPretraga" id="formaPretraga">
            @csrf
            <input class="form-control me-2" name="pretragaPolje" type="search" placeholder="" aria-label="Pretraga">
            <button type="submit" class="btn btn-primary" name="pretraga">Pretraži</button>
        </form>
    </div>
</div>