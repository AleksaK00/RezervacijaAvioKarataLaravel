<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Rezervacija, Korisnik, RezervisanaSedista, Promocija};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ManagerController extends Controller
{
    //Metoda koja prikazuje sve rezervacije i korisnicko ime rezervacije
    function prikaziRezervacije()
    {
        $rezervacije = Rezervacija::join('korisnik', 'rezervacija.ID_Korisnika', '=', 'korisnik.ID_Korisnika')->select('rezervacija.*', 'korisnik.Korisnicko_Ime as KorisnickoIme')->paginate(15);

        //Racunanje broja dana do polaska za svaku rezervaciju
        foreach ($rezervacije as $rezervacija)
        {
            $danaDo = Carbon::now()->diffInDays($rezervacija['Datum_Polaska']);
            $rezervacija['danaDo'] = $danaDo;
        }

        return view('manager.reservations', ['rezervacije' => $rezervacije]);
    }
    
    //Metoda koja pretrazuje rezervacije po koriscnickom imenu
    function pretraziRezervacije(Request $request)
    {
        $korisnici = Korisnik::where('Korisnicko_Ime', 'LIKE', '%' . $request->input('pretragaPolje') . '%')->select('ID_Korisnika')->get();

        $rezervacije = Rezervacija::whereIn('rezervacija.ID_Korisnika', $korisnici)->join('korisnik', 'rezervacija.ID_Korisnika', '=', 'korisnik.ID_Korisnika')
         ->select('rezervacija.*', 'korisnik.Korisnicko_Ime as KorisnickoIme')->paginate(15);

        //Racunanje broja dana do polaska za svaku rezervaciju
        foreach ($rezervacije as $rezervacija)
        {
            $danaDo = Carbon::now()->diffInDays($rezervacija['Datum_Polaska']);
            $rezervacija['danaDo'] = $danaDo;
        }

        return view('manager.reservations', ['rezervacije' => $rezervacije]);
    }

    
    //Metoda koja otkazuje zadatu rezervaciju
    function otkaziRezervaciju($brLeta, $datumPolaska , $IDkorisnika)
    {
        $rezervacija = Rezervacija::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->where('ID_Korisnika', $IDkorisnika)->first();
        $rezervacija['Otkazana'] = 1;
        $rezervacija->save();

        //Brisanje rezervisanih
        RezervisanaSedista::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->where('ID_Korisnika', $IDkorisnika)->delete();

        return redirect('/manager/reservations'); 
    }
    
    //Metoda koja ispisuje stranicu za upravljanje promocija
    function upravljajPromocijama()
    {
        $promocije = Promocija::all();

        return view('manager.promoManagment', ['promocije' => $promocije]);
    }

    //Metoda koja ubacuje novu promociju
    function novaPromocija(Request $request)
    {
        //validacija polja
        $validacija = Validator::make($request->all(), [
            'destinacijaUnos' => 'required',
            'tekstUnos' => 'required',
            'slikaUnos' => 'required|mimes:jpg'
        ], $messages = [
            'required' => 'Sva polja su obavezna!',
            'mimes' => 'slika mora da bude JPG'
        ]);

        if ($validacija->fails())
        {
            return redirect('/manager/promos')->withErrors($validacija);
        }

        //Ubacivanje nove promocije, osim ako promocija za grad vec postoji
        $promocijaPostoji = Promocija::where('Destinacija', $request->input('destinacijaUnos'))->first();
        if ($promocijaPostoji)
        {
            return redirect('/manager/promos')->withErrors('Promocija već postoji u bazi, obriši postojeću za unos nove verzije');
        }
        else
        {
            $novaPromocija = Promocija::create([
                'Destinacija' => $request->input('destinacijaUnos'),
                'Tekst' => $request->input('tekstUnos'),
                'Aktivan_Slot' => NULL
            ]);

            //prebacivanje slike u folder public/images/Promo
            Storage::disk('images')->putFileAs('Promo', $request->file('slikaUnos'), $novaPromocija['Destinacija'] . '.jpg');
        }

        return redirect('/manager/promos');
    }

    //Metoda za brisanje promocije
    function obrisiPromociju($IDpromocije)
    {
        $promocija = Promocija::where('ID', $IDpromocije)->first();
        Storage::disk('images')->delete('Promo/' . $promocija['Destinacija'] . '.jpg');
        $promocija->delete();

        return redirect('/manager/promos');
    }

    //Metoda za izmenu 3 aktivne promocije
    function izmeniAktivnePromocije(Request $request)
    {
        //validacija polja
        $validacija = Validator::make($request->all(), [
            'slot1Select' => 'different:slot2Select|different:slot3Select|gt:0',
            'slot2Select' => 'different:slot1Select|different:slot3Select|gt:0',
            'slot3Select' => 'different:slot1Select|different:slot2Select|gt:0'
        ], $messages = [
            'different' => 'Ista promocija ne može da bude u 2 slota!',
            'gt' => 'Svi slotovi moraju da imaju promociju!'
        ]);

        if ($validacija->fails())
        {
            return redirect('/manager/promos')->withErrors($validacija);
        }

        //Skidanje svih starih aktivnih promocija
        $stariSlotovi = Promocija::whereIn('Aktivan_Slot', ['1', '2', '3'])->get();
        foreach($stariSlotovi as $stariSlot)
        {
            $stariSlot['Aktivan_Slot'] = NULL;
            $stariSlot->save();
        }

        //Postavljanje svih novih aktivnih promocija
        Promocija::where('ID', $request->input('slot1Select'))->update(['Aktivan_Slot' => '1']);
        Promocija::where('ID', $request->input('slot2Select'))->update(['Aktivan_Slot' => '2']);
        Promocija::where('ID', $request->input('slot3Select'))->update(['Aktivan_Slot' => '3']);

        return redirect('manager/promos');
    }

}
