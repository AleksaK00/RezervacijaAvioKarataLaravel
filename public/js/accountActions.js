function RezervacijaZaBrisanje(brLeta, datumPolaska, IDkorisnika)
{
    document.getElementById('otkazi').href = '/reservation/' + brLeta + '/' + datumPolaska + '/' + IDkorisnika + '/cancel'; 
}