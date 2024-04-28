//Apro il menù laterale
const show_menu= document.querySelector('.person');
const nav=document.querySelector('.login_menu');

show_menu.onclick=()=>{
    nav.classList.toggle("show");
};

// Funzione per collegare il bottone al popup
function collegaBottoneAPopup() {
  // Seleziona il bottone desiderato
  var bottone = document.getElementById('mostraPopupButton');
  
  // Aggiungi un gestore per il clic sul bottone
  bottone.addEventListener('click', function() {
      // Mostra il popup al clic sul bottone
      mostraPopup();
  });
}

// Attivo la funzione
window.onload = function() {
  collegaBottoneAPopup();
};

// Funzione per mostrare il popup con una pagina web
function mostraPopup() {
  // Creazione dell'elemento iframe
  var iframe = document.createElement('iframe');
  iframe.src = '../login_registrazione/login.html'; // Sostituisci 'pagina_web_da_includere.html' con il percorso alla pagina web da includere
  iframe.className = 'popup';

  // Aggiunta dell'iframe al corpo del documento
  document.body.appendChild(iframe);

  // Aggiungo un gestore per il clic sul bottone di chiusura all'interno dell'iframe
  iframe.onload = function() {
    var closeButton = iframe.contentDocument.getElementById('closeButton');
    closeButton.addEventListener('click', function() {
      iframe.remove();
    });

    // Per chiudere il popup e reindirizzare l'utente a un'altra pagina quando si fa clic su un link all'interno del popup, puoi aggiungere un gestore per l'evento di clic su quel link. Nel gestore dell'evento, puoi rimuovere l'iframe del popup e quindi reindirizzare l'utente alla pagina desiderata.
    var paginaLink = iframe.contentDocument.getElementById('linkpagina');
    paginaLink.addEventListener('click', function(event) {
      event.preventDefault(); // Previeni l'azione predefinita del link (navigare alla pagina)
      iframe.remove(); // Rimuovi il popup
      window.location.href = paginaLink.href; // Reindirizza l'utente alla pagina specificata nel link
    });
  };
}

// funzione per la visbilità del campo password
function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var toggleIcon = document.querySelector(".password-toggle");
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.src = "../hidden.png"; // Cambia il percorso dell'immagine per l'occhio chiuso
  } else {
    passwordField.type = "password";
    toggleIcon.src = "../eye.png"; // Cambia il percorso dell'immagine per l'occhio aperto
  }
}

// Aggiungi un ascoltatore di eventi per controllare se il campo è vuoto o meno
document.addEventListener('DOMContentLoaded', function() {
  var inputs = document.querySelectorAll('input');
  inputs.forEach(function(input) {
    input.addEventListener('input', function() {
      if (this.value !== '') {
        this.classList.add('filled');
      } else {
        this.classList.remove('filled');
      }
    });
  });
});