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