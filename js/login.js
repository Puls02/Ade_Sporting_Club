//Apro il menù laterale
const show_menu= document.querySelector('.person');
const nav=document.querySelector('.login_menu');

show_menu.onclick=()=>{
    nav.classList.toggle("show");
};

// Funzione per mostrare il pop-up
function mostraPopUp() {
    document.getElementById("popup").style.display = "block";
}

// Funzione per nascondere il pop-up
function nascondiPopUp() {
    document.getElementById("popup").style.display = "none";
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

// Funzione per mostrare il popup con una pagina web
function mostraPopup() {
  // Creazione dell'elemento iframe
  var iframe = document.createElement('iframe');
  iframe.src = '../login_registrazione/login.html'; // Sostituisci 'pagina_web_da_includere.html' con il percorso alla pagina web da includere
  iframe.className = 'popup';

  // Aggiunta dell'iframe al corpo del documento
  document.body.appendChild(iframe);

  // Aggiunta di un gestore per chiudere il popup al clic su di esso
  iframe.addEventListener('click', function() {
      document.body.removeChild(iframe);
  });
}


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