<?php
    session_start();

    $userLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="StyleSheet" href="../Style/login.css">
    <script src="../js/login.js" defer></script>
    <style>
        /* Stile generale per il contenitore della pagina di login */
        body {
            overflow-x: hidden;
            background: transparent;
        }
        .boxx {
            position: relative;
            margin: 0;
        }
        .switch {
            z-index: 4;
            position: absolute;
            margin-top: 0;
            min-width: 90%;
            min-height: 50vh;
            background: rgba(17, 156, 221); /* Sfondo semi-trasparente */
            backdrop-filter: blur(10px); /* Effetto sfocatura */
            border-radius: 10px; /* Bordi arrotondati */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordo semi-trasparente */
            padding: 1%;
        }
        .container {
            position: absolute;
            padding: 1%;
            margin-top: 40px;
            margin-left: 20px;
            width: auto;
            min-width: 90%;
            min-height: 300px;
            background: rgba(9, 132, 189); /* Sfondo semi-trasparente */
            backdrop-filter: blur(10px); /* Effetto sfocatura */
            border-radius: 10px; /* Bordi arrotondati */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordo semi-trasparente */
            z-index: 5;
            color: black;
        }
        
        .istruttore {
            display: none;
        }
        button {
            cursor: pointer;
            background: transparent;
            color: rgb(0, 0, 0);
            border: none;
            border-bottom: 1px solid rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <div class="boxx">
        <div class="container cliente">
            <form action="../php/logUtente.php" method="post" name="log" id="popup" class="formlogin" target="_top"> <!-- importante per i comportamenti automatici del form -->
                <h1 class="title">login</h1>
                <img src="../immagini/login/close.png"  alt="x per chiudere" class="close" id="closeButton">
                <div class="box">
                    <input id="mail" type="email" class="field" name="indirizzomail" size="30" maxlength="30" required>
                    <label for="mail" class="labellogin">E-mail: </label>
                    <img class="imagelogin" src="../immagini/login/mail.png" alt="icona mail">
                </div>
                <div class="box">
                    <input type="password" id="password" class="field" name="password" size="15" maxlength="15" required>
                    <label for="password" class="labellogin">Password: </label> 
                    <img src="../immagini/login/hidden.png" alt="Mostra/Nascondi password" class="password-toggle" onclick="togglePasswordVisibility()">
                </div>
                <input class="loginbutton" type="submit" value="Accedi"> 
                <p>Non hai ancora un account? <a id="linkToClosePopup" href="registration.php">Registrati qui</a></p>
            </form>
        </div>

        <div class="container istruttore">
            <form action="../php/logUtente.php" method="post" name="log" id="popup" class="formlogin" target="_top"> <!-- importante per i comportamenti automatici del form -->
                <h1 class="title">login</h1>
                <img src="../immagini/login/close.png"  alt="x per chiudere" class="close" id="closeButton">
                <div class="box">
                    <input id="id" type="text" class="field" name="id" size="30" maxlength="30" required>
                    <label for="id" class="labellogin">ID: </label>
                    <img class="imagelogin" src="../immagini/login/mail.png" alt="icona mail">
                </div>
                <div class="box">
                    <input type="password" id="password" class="field" name="password" size="15" maxlength="15" required>
                    <label for="password" class="labellogin">Password: </label> 
                    <img src="../immagini/login/hidden.png" alt="Mostra/Nascondi password" class="password-toggle" onclick="togglePasswordVisibility()">
                </div>
                <input class="loginbutton" type="submit" value="Accedi"> 
            </form>            
        </div>   
        <div class="switch">
            <button id="buttonSwitch">Area istruttori</button>
        </div>
    </div>

    <script>
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
    </script>
    
</body>
</html>