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
    <nav class="nav responsive">
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
            
            <div class="linksito">
                <div class="login_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="person flex">
                    <ul class="login_menu">
                        <!-- Condizione PHP per mostrare il menu di login -->
                        <?php if (!$logged) : ?>
                            <li>
                                <p class="bold"><b>Registrati o Accedi</b></p>
                            </li>
                            <li>
                                <p>Scopri tutte le funzionalità del sito</p>
                            </li>
                            <hr size="1" color="black">
                            <li>
                                <a href="login_registrazione/registration.php">
                                    <button class="Sign up">Registrati</button>
                                </a>
                            </li>
                            <li>
                                <button class="Sign in" id="mostraPopupButton">Accedi</button>
                            </li>
                        <?php else: ?>
                            <!-- Condizione PHP per mostrare il profilo -->
                            <li>
                                <?php if ($id < 30) : ?>
                                    <a href="login_registrazione/Istruttore.php">
                                        <button class="Sign profile">Profilo</button>
                                    </a>
                                <?php elseif ($id > 30 && !$gold) : ?>
                                    <a href="login_registrazione/utenteNonGold.php">
                                        <button class="Sign profile">Profilo</button>
                                    </a>
                                <?php else : ?>
                                    <a href="login_registrazione/utenteGold.php">
                                        <button class="Sign profile">Profilo</button>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <form action="php/logout.php" method="post">
                                    <button class="Sign out" type="submit">Logout</button>
                                </form>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="hamburger_menu" onclick="showSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                </div>
        </div>
                <ul class="sidebar"> 
                    <li class="side_exit" onclick=hideSidebar()>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 
                            1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 
                            12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <h3 class="side_name">ADE Sporting Club</h3>
                    </li>
                    <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="Struttura.php">Struttura</a>
                </li>
                <li>
                    <a href="Attivita.php"> Attività</a>
                </li>               
                <li>
                    <a href="Prenota.php">Prenota</a>
                </li>
            </ul>
            <!-- javascript for sidebar menu -->
            <script>
                function showSidebar() 
                {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.style.display = 'flex';
                }
                function hideSidebar()
                {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.style.display = 'none';
                }
            </script>
            <!-- end javascript -->
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
            <label>Che tipo di abbonamento vuoi sottoscrivere: </label><br>
                    <input type="radio" name="corso_campo" value="corso" onclick="toggleFields()"/><label>Voglio seguire i corsi</label>
                    <input type="radio" name="corso_campo" value="campo" onclick="toggleFields()"/><label>Prenoterò solo i campi</label>
            <br><label>Tipo di abbonamento:</label>
            <select name="type" id="abbonamento" onclick="return checkRegistration()" >
                <option value="">Seleziona</option>
                <option value="AM">Abbonamento mensile</option>
                <option value="AT">Abbonamento trimestrale</option>
                <option value="AS">Abbonamento semestrale</option>
                <option value="AA">Abbonamento annuale</option>
            </select><br>
            <label>Livello: </label>
            <select name="abbonamentospecifico" id="listastatus" onclick="checkType()" onchange="resetCheckboxes(); checkSubscription()">
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
            <label>Selezionare la categoria dei corsi: </label><br>
                    <input type="radio" name="categoria" value="bambini" /><label>Bambini</label>
                    <input type="radio" name="categoria" value="ragazzi" /><label>Ragazzi</label>
                    <input type="radio" name="categoria" value="amatoriale" /><label>Amatoriale</label>
            <br/>
            Per completare la registrazione avremo bisogno di un documento d'identità e del certificato medico, inseriscili qui sotto in formato pdf o immagine oppure portali in reception:
            <br>
            <input type="file" id="identity" name="identity" value="Documento d'identità" accept=".pdf, .png, .jpeg, .jpg" multiple>
            <input type="file" id="certmed" name="certmed" value="Certificato medico" accept=".pdf, .png, .jpeg, .jpg" multiple>
            <br>
        </div>
        <input type="submit" value="invia form" >
        <input type="reset" value="reset form">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Ottieni l'elemento con il nome "nata"
        var inputDate = document.getElementsByName("nata")[0];

        // Seleziona la data corrente
        var now = new Date();

        // Imposta la data minima come la data corrente meno 12 anni
        var maxDate = new Date(now.getTime());
        maxDate.setFullYear(maxDate.getFullYear() - 12);
        var maxData = maxDate.toISOString().split('T')[0];

        // Imposta l'attributo max dell'input date
        inputDate.max = maxData;
    });
</script>
    
</body>
</html>