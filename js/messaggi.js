document.addEventListener('DOMContentLoaded', function() {
    var messaggio = document.getElementById('messaggiAlto');
    if (messaggio) {
        messaggio.style.display = 'block';
            setTimeout(function() {
                messaggio.style.display = 'none';
            }, 3000); // nasconde il messaggio dopo 3 secondi
        }
    });
