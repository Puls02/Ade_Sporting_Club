/* JS per la nav bar*/

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