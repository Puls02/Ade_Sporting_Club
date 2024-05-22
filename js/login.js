// Attivo la funzione
window.onload = function() {
  collegaBottoneAPopup();
};

// funzione per la visbilità del campo password
function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var toggleIcon = document.querySelector(".password-toggle");
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.src = "../immagini/login/hidden.png"; // Cambia il percorso dell'immagine per l'occhio chiuso
  } else {
    passwordField.type = "password";
    toggleIcon.src = "../immagini/login/eye.png"; // Cambia il percorso dell'immagine per l'occhio aperto
  }
};
// funzione per la visbilità del campo password
function togglePasswordVisibilityIst() {
  var passwordField = document.getElementById("passwordIst");
  var toggleIcon = document.querySelector(".password-toggle");
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.src = "../immagini/login/hidden.png"; // Cambia il percorso dell'immagine per l'occhio chiuso
  } else {
    passwordField.type = "password";
    toggleIcon.src = "../immagini/login/eye.png"; // Cambia il percorso dell'immagine per l'occhio aperto
  }
};

// Funzione per collegare il bottone al popup
function collegaBottoneAPopup() {
  // Seleziona il bottone desiderato
  var bottone = document.getElementById('mostraPopupButton');
  var popup = document.getElementById('popup');
  var overlay = document.getElementById('overlay');
  var corpo = document.querySelector('main'); // Seleziona il main per sfocare il suo contenuto

  // Aggiungi un gestore per il clic sul bottone
  bottone.addEventListener('click', function() {
    // Mostra il popup e l'overlay al clic sul bottone
    popup.style.display = 'block';
    overlay.style.display = 'block';
    // Aggiungi la classe blur al main
    corpo.classList.add('blur-background');
  });

  // Aggiungi un gestore per il messaggio 'closePopup'
  window.addEventListener('message', function(event) {
    // Controlla se il messaggio ricevuto è 'closePopup'
    if (event.data === 'closePopup') {
      // Chiudi il popup e l'overlay
      popup.style.display = 'none';
      overlay.style.display = 'none';
      // Rimuovi la classe blur dal main
      corpo.classList.remove('blur-background');
    }
  });
}

//
/* per gestire los cambio delle pagine */
document.getElementById('buttonSwitch').addEventListener('click', function() {
  var clientiSection = document.querySelector('.cliente');
  var istruttoriSection = document.querySelector('.istruttore');
  var btn = document.getElementById('buttonSwitch');
  
  // Controlla quale sezione è attiva e cambia di conseguenza
  if (clientiSection.style.display !== 'none') {
      clientiSection.style.display = 'none';
      istruttoriSection.style.display = 'block';
      btn.textContent = 'Passa a Clienti';
  } else {
      istruttoriSection.style.display = 'none';
      clientiSection.style.display = 'block';
      btn.textContent = 'Passa a Istruttori';
  }
});

/* per chiudere il popup */
document.getElementById('closeButton').addEventListener('click', function() {
  window.parent.postMessage('closePopup', '*'); // Comunica al genitore di chiudere il popup
});

document.getElementById('closeButtonIst').addEventListener('click', function() {
  window.parent.postMessage('closePopup', '*'); // Comunica al genitore di chiudere il popup
});

/* per gestire i link */
document.addEventListener('DOMContentLoaded', function() {
  var linkToClosePopup = document.getElementById('linkToClosePopup');
  linkToClosePopup.addEventListener('click', function(event) {
      event.preventDefault(); // Previeni il comportamento predefinito del link
      window.parent.postMessage('closePopup', '*'); // Comunica al genitore di chiudere il popup
      var targetURL = linkToClosePopup.getAttribute('href'); // Ottieni l'URL di destinazione dal link
      setTimeout(function() {
          window.parent.location.href = targetURL; // Reindirizza alla pagina specificata nel link utilizzando la finestra genitore
      }, 400); // Aspetta 400 millisecondi prima di reindirizzare per permettere la chiusura del popup
  });
});
