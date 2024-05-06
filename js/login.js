//Apro il menù laterale
/*
const show_menu= document.querySelector('.person');
const nav=document.querySelector('.login_menu');

show_menu.onclick=()=>{
    nav.classList.toggle("show");
};
*/

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

// Funzione per collegare il bottone al popup
function collegaBottoneAPopup() {
  // Seleziona il bottone desiderato
  var bottone = document.getElementById('mostraPopupButton');
  var popup = document.getElementById('popup');

  // Aggiungi un gestore per il clic sul bottone
  bottone.addEventListener('click', function() {
      // Mostra il popup al clic sul bottone
      popup.style.display = 'block';
  });

  // Aggiungi un gestore per il messaggio 'closePopup'
  window.addEventListener('message', function(event) {
    // Controlla se il messaggio ricevuto è 'closePopup'
    if (event.data === 'closePopup') {
      // Chiudi il popup
      popup.style.display = 'none';
    }
  });
};
