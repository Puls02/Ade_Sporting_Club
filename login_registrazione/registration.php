<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>
    
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/navbar.css">
    <link rel="StyleSheet" href="Style/login.css">
    

    <script src="js/registration.js"></script>
    <script src="js/navbar.js" defer></script>

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
                    <a class="toolbar_link_Home" href="../index.html">Home</a>
                </li>
                <li>
                    <a class="toolbar_link_Struttura" href="../Struttura.html">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="../Attivita.html"> Attività</a>
                </li>
                <li>
                    <a class="toolbar_link_Ristorante" href="Ristorante.html">Ristorante</a>
                </li>
                <li>
                    <a class="toolbar_link_Eventi" href="Eventi.html">Eventi</a>
                </li>                
                <li>
                    <a class="toolbar_link_Prenota" href="../Prenota.html">Prenota</a>
                </li>
                <li>
                    <a class="toolbar_link_Soci" href="Soci.html">Soci</a> 
                </li>
            </ul>

            <!--container for login features--> <!--Inserire un link sign in, sign up e un bottone con l'immagine che se cliccato ti apre un menu con accedi e registrati-->
            <div class="person flex container">
            </div>
            
            
        </nav>
        
        <script src="../js/login.js"></script>
    </header>
    <form action="../php/registrazione.php" method="post" name="registr" onsubmit="checkForm(event)"> <!-- importante per i comportamenti automatici del form -->
        <label>Cognome: </label><input type="text" name="cognome" size="40" maxlength="40" required></br>
        <label>Nome: </label><input type="text" name="nome" size="30" maxlength="30" required>
        <br/>Sesso:
                <br/><input type="radio" name="sesso" />Maschio
                <br/><input type="radio" name="sesso" />Femmina
        <br/>
        <label>Residenza: </label><input type="text" name="residenza" size="40" maxlength="40" required></br>
        <label>Nato/a a: </label><input type="text" placeholder="luogo" name="nascita" required/> il <input type="date" name="nata" required><br/>
        <label>E-mail: </label><input type="email" name="indirizzomail" size="30" maxlength="30"></br>
        <label>Password: </label><input type="password" name="password" size="30" maxlength="30" required></br>
        <label>Telefono: </label><input type="tel" name="telefono" size="15" maxlength="15" required></br>
        <label>ABBONAMENTO</label><br>
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
                    <input type="checkbox" name="corso" value="calcio"  oninput="checkSubscription(event)">Calcio
                </label>
                <label>
                    <input type="checkbox" name="corso" value="basket"  oninput="checkSubscription(event)">Basket
                </label>
                <label>
                    <input type="checkbox" name="corso" value="tennis"  oninput="checkSubscription(event)">Tennis
                </label>
                <label>
                    <input type="checkbox" name="corso" value="paddle"  oninput="checkSubscription(event)">Paddle
                </label>
                <label>
                    <input type="checkbox" name="corso" value="nuoto" oninput="checkSubscription(event)">Nuoto
                </label>
                <label>
                    <input type="checkbox" name="corso" value="palestra" >Palestra
                </label>
        <br/>
        <input type="file" id="identity" name="identity" value="Documento d'identità" accept=".pdf, .png, .jpeg" multiple>
        <input type="file" id="certmed" name="certmed" value="Certificato medica" accept=".pdf, .png, .jpeg" multiple>
        <br>
        <input type="submit" value="invia form" >
        <input type="reset" value="reset form">
    </form>
    
</body>
</html>