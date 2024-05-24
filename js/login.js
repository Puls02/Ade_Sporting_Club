// I activate the function
window.onload = function () {
    collegaBottoneAPopup();
};

// function for visibility of the password field
function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    var toggleIcon = document.querySelector('.password-toggle');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.src = '../immagini/login/hidden.png'; // Change the image path for the closed eye
    } else {
        passwordField.type = 'password';
        toggleIcon.src = '../immagini/login/eye.png'; // Change the image path for the open eye
    }
}
// function for visibility of the password field
function togglePasswordVisibilityIst() {
    var passwordField = document.getElementById('passwordIst');
    var toggleIcon = document.querySelector('.password-toggle');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.src = '../immagini/login/hidden.png'; // Change the image path for the closed eye
    } else {
        passwordField.type = 'password';
        toggleIcon.src = '../immagini/login/eye.png'; // Change the image path for the open eye
    }
}

// Function to connect the button to the popup
function collegaBottoneAPopup() {
    // Select the desired button
    var bottone = document.getElementById('mostraPopupButton');
    var popup = document.getElementById('popup');
    var overlay = document.getElementById('overlay');
    var corpo = document.querySelector('main'); // Select the main to blur its contents

    // Add a button click handler
    bottone.addEventListener('click', function () {
        // Show popup and overlay on button click
        popup.style.display = 'block';
        overlay.style.display = 'block';
        // Add the blur class to main
        corpo.classList.add('blur-background');
    });

    // Add a handler for the 'closePopup' message
    window.addEventListener('message', function (event) {
        // Check if the message received is 'closePopup'
        if (event.data === 'closePopup') {
            // Close the popup and overlay
            popup.style.display = 'none';
            overlay.style.display = 'none';
            //Remove the blur class from main
            corpo.classList.remove('blur-background');
        }
    });
}

//
/* per gestire los cambio delle pagine */
document.getElementById('buttonSwitch').addEventListener('click', function () {
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
document.getElementById('closeButton').addEventListener('click', function () {
    window.parent.postMessage('closePopup', '*'); // Comunica al genitore di chiudere il popup
});

document
    .getElementById('closeButtonIst')
    .addEventListener('click', function () {
        window.parent.postMessage('closePopup', '*'); // Comunica al genitore di chiudere il popup
    });

/* per gestire i link all'interno del popup */
document.addEventListener('DOMContentLoaded', function () {
    var linkToClosePopup = document.getElementById('linkToClosePopup');
    linkToClosePopup.addEventListener('click', function (event) {
        event.preventDefault(); // Previeni il comportamento predefinito del link
        window.parent.postMessage('closePopup', '*'); // Comunica al genitore di chiudere il popup
        var targetURL = linkToClosePopup.getAttribute('href'); // Ottieni l'URL di destinazione dal link
        setTimeout(function () {
            window.parent.location.href = targetURL; // Reindirizza alla pagina specificata nel link utilizzando la finestra genitore
        }, 400); // Aspetta 400 millisecondi prima di reindirizzare per permettere la chiusura del popup
    });
});
