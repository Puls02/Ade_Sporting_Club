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
    <link rel="StyleSheet" href="../Style/utility.css">
    
    <script src="../js/login.js" defer></script>
    
</head>
<body>
    <div class="boxx">
        <div class="container cliente">
            <form action="../php/logUtente.php" method="post" name="log" id="popup" class="formlogin" target="_top"> <!-- importante per i comportamenti automatici del form -->
                <h1 class="title">login</h1>
                <img src="../immagini/login/close.png"  alt="x per chiudere" class="close" id="closeButton">
                <div class="box">
                    <input id="mail" type="email" class="field" name="indirizzomail" size="40" maxlength="40" required>
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
            <form action="../php/logIstruttore.php" method="post" name="log" id="popup" class="formlogin" target="_top"> <!-- importante per i comportamenti automatici del form -->
                <h1 class="title">login</h1>
                <img src="../immagini/login/close.png"  alt="x per chiudere" class="close" id="closeButtonIst">
                <div class="box">
                    <input id="id" type="text" class="field" name="codice" size="30" maxlength="30" required>
                    <label for="id" class="labellogin">Inserisci il tuo codice: </label>
                    <img class="imagelogin" src="../immagini/login/mail.png" alt="icona mail">
                </div>
                <div class="box">
                    <input type="password" id="passwordIst" class="field" name="password" size="15" maxlength="15" required>
                    <label for="password" class="labellogin">Password: </label> 
                    <img src="../immagini/login/hidden.png" alt="Mostra/Nascondi password" class="password-toggle" onclick="togglePasswordVisibilityIst()">
                </div>
                <input class="loginbutton" type="submit" value="Accedi"> 
                <br>
            </form>            
        </div>   
        <div class="switch">
            <button id="buttonSwitch">Area istruttori</button>
        </div>
    </div>    
</body>
</html>