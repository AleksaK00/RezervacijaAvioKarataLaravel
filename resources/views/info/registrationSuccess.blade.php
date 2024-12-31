<x-layout>
    <x-messageBox goToPage="/" clickableText="Nazad na početnu stranu">
        Uspešna Registracija. Dobrodošli {{Request::cookie('korisnik')}}
    </x-messageBox>
</x-layout>