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

//---------------------------------------------------------------

// Funzione per collegare il bottone al popup
function collegaBottoneAPopup() {
  // Seleziona il bottone desiderato
  var bottone = document.getElementById('mostraPopupButton');
  var popup = document.getElementById('popup');
  var popupLink = document.getElementById('popupLink');

  // Aggiungi un gestore per il clic sul bottone
  bottone.addEventListener('click', function() {
      // Mostra il popup al clic sul bottone
      popup.style.display = 'block';
  });

  // Aggiungi un gestore per il clic sul bottone di chiusura del popup
  var closeButton = document.getElementById('closeButton');
  closeButton.addEventListener('click', function() {
      // Chiudi il popup
      popup.style.display = 'none';
  });

  // Aggiungi un gestore per il clic sul link all'interno del popup
  popupLink.addEventListener('click', function(event) {
    // Chiudi il popup
    popup.style.display = 'none';
});
}