<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>
    
    <link rel="StyleSheet" href="../Style/utility.css">
    <link rel="StyleSheet" href="../Style/navbar.css">
    <link rel="StyleSheet" href="../Style/registration.css">
    

    <script src="../js/registrazioneU.js" defer></script>
    <script src="../js/navbar.js" defer></script>

</head>
<body>

    <!--Header, there is the navbar menu and login-->
    <header> 
        <nav class="nav container">
            <!--container for logo and name-->
            <ul class="logo container"> 
                <li>
                    <img class="logo_img" src="../immagini/logo/Ade.jpg">
                </li>
                <li>
                    <a class="logo_name">ADE Sporting Club</a>                
                </li>
            </ul>
            <!--container for navbar, topBotomBordersOut is the name of the toolbar animation-->
            <ul class="toolbar container topBotomBordersOut"> 
                <li>
                    <a class="toolbar_link_Home" href="../index.php">Home</a>
                </li>
                <li>
                    <a class="toolbar_link_Struttura" href="../Struttura.php">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="../Attivita.php"> Attività</a>
                </li>             
                <li>
                    <a class="toolbar_link_Prenota" href="../Prenota.php">Prenota</a>
                </li>
            </ul>

            <!--container for login features--> <!--Inserire un link sign in, sign up e un bottone con l'immagine che se cliccato ti apre un menu con accedi e registrati-->
            <div class="login_btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="person flex container">
            </div>
            
            
        </nav>

        <script src="../js/login.js"></script>
    </header>
    <div class="banner" ></div>
    <form action="../php/regUtente.php" method="post" name="registr" onsubmit="checkForm(event)"> <!-- importante per i comportamenti automatici del form -->
        <h1>REGISTRAZIONE</h1>
        <h3>compila il form e unisciti alla nostra comunity</h3>
        <div class="section">
            <label class="title">INFORMAZIONI PERSONALI</label>
            <label>Cognome: </label><input type="text" name="cognome" size="40" maxlength="40" required></br>
            <label>Nome: </label><input type="text" name="nome" size="30" maxlength="30" required>
            <br/><label>Sesso: </label>
                    <input type="radio" name="sesso" value="M"/><label>Maschio</label>
                    <input type="radio" name="sesso" value="F"/><label>Femmina</label>
            <br/>
            <label>Residenza: </label><input type="text" name="residenza" size="40" maxlength="40" required></br>
            <label>Nato/a a: </label><input type="text" name="nascita" required/> il <input type="date" name="nata" required><br/>
            <label>Telefono: </label><input type="tel" name="telefono" size="15" maxlength="15" required></br>
        </div>
        <div class="section">
            <label class="title">CREDENZIALI ACCESSO</label>
            <label>E-mail: </label><input type="email" name="indirizzomail" size="30" maxlength="30"></br>
            <label>Password: </label><input type="password" name="password" size="30" maxlength="30" required></br>
        </div>
        <div class="section">
            <label class="title">INFORMAZIONI ABBONAMENTO</label>
            <label>Tipo di abbonamento:</label>
            <select name="type" id="abbonamento"  required>
                <option value="">Seleziona</option>
                <option value="AM">Abbonamento mensile</option>
                <option value="AT">Abbonamento trimestrale</option>
                <option value="AS">Abbonamento semestrale</option>
                <option value="AA">Abbonamento annuale</option>
            </select><br>
            <label>Livello: </label>
            <select name="abbonamentospecifico" id="listastatus" onclick="checkType()" onchange="resetCheckboxes(); checkSubscription()" required>
                <option value="">Seleziona</option>
                <option value="single">Abbonamento singolo</option>
                <option value="double">Abbonamento doppio</option>
                <option value="gym" >Abbonamento palestra</option>
                <option value="opengym">Abbonamento palestra open</option>
                <option value="gold">Socio gold</option>
            </select></br>
            Seleziona corsi:<br>
                    <label>
                        <input type="checkbox" name="corso[]" value="Calcio"  oninput="checkSubscription(event)">Calcio
                    </label>
                    <label>
                        <input type="checkbox" name="corso[]" value="Basket"  oninput="checkSubscription(event)">Basket
                    </label>
                    <label>
                        <input type="checkbox" name="corso[]" value="Tennis"  oninput="checkSubscription(event)">Tennis
                    </label>
                    <label>
                        <input type="checkbox" name="corso[]" value="Paddle"  oninput="checkSubscription(event)">Paddle
                    </label>
                    <label>
                        <input type="checkbox" name="corso[]" value="Nuoto" oninput="checkSubscription(event)">Nuoto
                    </label>
                    <label>
                        <input type="checkbox" name="corso[]" value="Palestra" >Palestra
                    </label>
            <br/>
        
            Se sei un cliente inserisci il documento d'identità e il certificato medico:
            <br>
            <input type="file" id="identity" name="identity" value="Documento d'identità" accept=".pdf, .png, .jpeg" multiple>
            <input type="file" id="certmed" name="certmed" value="Certificato medico" accept=".pdf, .png, .jpeg" multiple>
            <br>
        </div>
        <input type="submit" value="invia form" >
        <input type="reset" value="reset form">
    </form>
    
</body>
</html>