// for managing alert messages
document.addEventListener('DOMContentLoaded', function () {
    var messaggio = document.getElementById('messaggiAlto');
    if (messaggio) {
        messaggio.style.display = 'block';
        setTimeout(function () {
            messaggio.style.display = 'none';
        }, 4000); // nasconde il messaggio dopo 4 secondi
    }
});
