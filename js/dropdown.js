const show_menu = document.querySelector('.login_btn');
const nav = document.querySelector('.person');

show_menu.onclick = () => {
    nav.classList.toggle('show');
};
