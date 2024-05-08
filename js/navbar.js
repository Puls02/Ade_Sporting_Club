/* JS per la nav bar*/

const show_menu= document.querySelector('.person');
const nav=document.querySelector('.login_menu');

show_menu.onclick=()=>{
    nav.classList.toggle("show");
};
