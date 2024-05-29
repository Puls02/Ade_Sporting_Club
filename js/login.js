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
// function for visibility of the password field (instructor login)
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

// to manage page changes
document.getElementById('buttonSwitch').addEventListener('click', function () {
    var clientiSection = document.querySelector('.cliente');
    var istruttoriSection = document.querySelector('.istruttore');
    var btn = document.getElementById('buttonSwitch');

    // Check which section is active and change accordingly
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

// To close the popup 
document.getElementById('closeButton').addEventListener('click', function () {
    window.parent.postMessage('closePopup', '*'); 
});

document.getElementById('closeButtonIst').addEventListener('click', function () {
    window.parent.postMessage('closePopup', '*'); 
});

// To manage links within the popup
document.addEventListener('DOMContentLoaded', function () {
    var linkToClosePopup = document.getElementById('linkToClosePopup');
    linkToClosePopup.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        window.parent.postMessage('closePopup', '*'); // Tell the parent to close the popup
        var targetURL = linkToClosePopup.getAttribute('href'); // Get the destination URL from the link
        setTimeout(function () {
            window.parent.location.href = targetURL; // Redirects to the page specified in the link using the parent window
        }, 400); // Wait 400 milliseconds before redirecting to allow the popup to close
    });
});
