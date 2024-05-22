<?php
    session_start();

    $logged=isset($_SESSION['logged_in']);
    $gold=isset($_SESSION['gold']);
    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
    }
    
    include_once "php/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Serve per inserire un'icona nel title. Ho generato l'icona dal sito https://www.favicon-generator.org/ -->
    <link rel="icon" type="image/png" sizes="32x32" href="immagini/logo/favicon2.png">
    <title>Ade Sporting Club</title>

    <!-- Link to style folder -->
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/Stickynavbar.css">
    <link rel="StyleSheet" href="Style/footer.css">
    <link rel="StyleSheet" href="Style/index.css">
    <link rel="stylesheet" href="Style/popup.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- per le cione delle attivita -->

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>

</head>

<body>
    <!--Header, there is the navbar menu and login-->
    <header id="beginning"> 
        <nav class="nav responsive">
            <!-- container for logo and name -->
            <ul class="logo container">
                <li>
                    <img class="logo_img" src="immagini/logo/Ade.jpg">
                </li>
                <li>
                    <a class="logo_name">ADE Sporting Club</a>
                </li>
            </ul>
            <!-- container for navbar, topBotomBordersOut is the name of the toolbar animation -->
            <ul class="toolbar container topBotomBordersOut">
                <li>
                    <a class="toolbar_link_Home" href="index.php">Home</a>
                </li>
                <li>
                    <a class="toolbar_link_Struttura" href="Struttura.php">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="Attivita.php"> Attività</a>
                </li>
                <li>
                    <a class="toolbar_link_Prenota" href="Prenota.php">Prenota</a>
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
                <li class="side_exit" onclick="hideSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
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

            <!-- JavaScript for sidebar menu -->
            <script>
                function showSidebar() {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.style.display = 'flex';
                }

                function hideSidebar() {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.style.display = 'none';
                }

                // Dropdown menu for login
                const show_menu = document.querySelector('.login_btn');
                const nav = document.querySelector('.person');

                show_menu.onclick = () => {
                    nav.classList.toggle("show");
                };
            </script>

            <!-- Sticky navbar on scroll -->
            <script type="text/javascript">
                window.addEventListener("scroll", function () {
                    var header = document.querySelector("header");
                    header.classList.toggle("sticky", window.scrollY > 0);
                });
            </script>
    </nav>
    </header>

    <!--Banner del sito-->
    <section class="banner container">
        <video class="cover-video" autoplay loop muted>
            <source src="immagini/galleria/Banner.mp4" type="video/mp4">
        </video>
    </section>

    <hr size="4" color="black"> 

    <!-- Div per l'overlay -->
    <div id="overlay" class="overlay"></div>
    <!-- Div nascosto del popup -->
    <div id="popup" class="popup">
        <iframe src="login_registrazione/login.php" width="580" height="500" frameborder="0" style="border:0; overflow:hidden;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <main>
        <!--Contenuto della home page-->
        <div class="presentation">
            <h1>ADE Sporting Club Center</h1>
            <p>Se sei alla ricerca di un luogo dove coltivare la tua passione per lo sport, mantenersi in forma e rilassarsi 
                in un ambiente accogliente e dinamico, sei nel posto giusto!
                Presso il Club Sportivo ADE offriamo una vasta gamma di servizi e attività sportive per soddisfare ogni tua esigenza. 
                Dalla palestra attrezzata con macchinari all'avanguardia ai campi da tennis e calcetto, dalla piscina alle lezioni di nuoto, 
                fino all'area relax, troverai tutto quello che ti serve per raggiungere i tuoi obiettivi di benessere e salute.
            </p>
        </div>
        <!--descrizione generale del sito (corsi, ingresso, vantaggi soci) zig-zag layout -->
        <div class="Sezione_1">
            <hr size="4" color="black"> 
            <div class="zig-zag livello 1">
                <div class="fixed-image" style="background-image: url('immagini/sfondo_index/generico_blur.jpg');">
                    <div class="generic">
                        <img class="img-container" src="immagini/sfondo_index/generico.jpg">
                        <div class="text-container">
                            <h1>I Nostri Corsi</h1>
                            <p>Nel nostro centro potete trovare una grande quantità di attività, sia se volete allenarvi seguiti da un istruttore, 
                                sia se volete organizzare partite con amici. 
                                Potete trovare laboratori sportivi per bambini e corsi per adulti di ogni età.
                            </p>
                        </div> 
                    </div>
                </div>    
            </div>
            <hr size="4" color="black"> 
            <div class="space"></div>
            <hr size="4" color="black">
            <div class="zig-zag livello 2">
                <div class="fixed-image" style="background-image: url('immagini/sfondo_index/membership_blur.jpg');">
                    <div class="generic">
                        <div class="text-container">
                            <h1>Diventa Socio</h1>
                            <p>Diventando socio del nostro club avrai accesso a una vasta gamma di servizi e attività per soddisfare ogni tua esigenza sportiva e di benessere.
                                Che tu sia un appassionato di palestra, un amante del tennis, un nuotatore o semplicemente cerchi un posto dove rilassarti 
                                e staccare dalla routine quotidiana, il nostro club è la scelta ideale per te.  
                            </p>
                        </div>
                        <img class="img-container" src="immagini/sfondo_index/membership.jpg">
                    </div>
                </div>
                <hr size="4" color="black">     
            </div>
            <hr size="4" color="black"> 
            <div class="space"></div>
            <hr size="4" color="black">
            <div class="zig-zag livello 3">
                <div class="fixed-image" style="background-image: url('immagini/sfondo_index/relax_blur.jpg');">
                    <div class="generic">
                        <img class="img-container" src="immagini/sfondo_index/relax.jpg">
                        <div class="text-container">
                            <h1>Rilassati</h1>
                            <p>Presso il nostro club non ci occupiamo solo del tuo benessere fisico, ma anche di quello mentale e emotivo. 
                                L'Area Relax è il luogo ideale per rigenerarti, rilassarti e prenderti cura di te stesso dopo un'intensa sessione 
                                di allenamento o una lunga giornata di lavoro.
                            </p>
                        </div>
                    </div>
                </div>
                <hr size="4" color="black">     
            </div>
        </div>
        <div class="space"></div>
        <!--Responsive Image Slider-->
        <div class="Sezione_2">
            <div class="carosello">
                <div class="img-slider">
                    <div class="slide 1 active">
                        <img class="background-slide1" src="immagini/sfondo_index/calcio.png">
                        <div class="illustration">
                            <img class="tennis" src="immagini/sfondo_index/calcio1.jpg">
                        </div>
                        <div class="info">
                            <h1>CALCIO</h1>
                            <p> Scopri il piacere e l'energia del gioco che unisce milioni di persone in tutto il mondo. 
                                Che tu sia un professionista navigato o un appassionato dilettante, qui troverai uno spazio dove coltivare la tua passione per il gioco.
                                I nostri campi vantano strutture moderne e all'avanguardia progettate per garantire un'esperienza di gioco ottimale 
                                e sono dotate di strutture di supporto come spogliatoi e tribune per offrirti un ambiente confortevole e sicuro per goderti il tuo tempo sul campo.
                            </p>
                            <div class="collegamenti">
                                <a href="attivita.php">
                                    <button>Vai alla pagina del corso</button>
                                </a>
                                <a href="prenota.php">
                                    <button>Prenota un campo</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide 2">
                        <img class="background-slide2" src="immagini/sfondo_index/padel.png">
                        <div class="illustration">
                            <img class="tennis" src="immagini/sfondo_index/padle1.jpg">
                        </div>
                        <div class="info">
                            <h1>PADLE</h1>
                            <p>Presso il nostro campo, vi invitiamo a sperimentare l'emozione di questo sport dinamico in un ambiente professionale e amichevole.
                                Le nostre strutture all'avanguardia sono progettate per offrire la migliore esperienza di gioco possibile. 
                                Dai campi ben tenuti alle aree di osservazione per gli spettatori, tutto è pensato per garantire il massimo comfort 
                                e divertimento durante la vostra partita.
                            </p>
                            <div class="collegamenti">
                                <a href="attivita.php">
                                    <button>Vai alla pagina del corso</button>
                                </a>
                                <a href="prenota.php">
                                    <button>Prenota un campo</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide 3">
                        <img class="background-slide3" src="immagini/sfondo_index/tennis.png">
                        <div class="illustration">
                            <img class="tennis" src="immagini/sfondo_index/tennis1.jpg">
                        </div>
                        <div class="info">
                            <h1>TENNIS</h1>
                            <p>Il tennis è uno sport intramontabile che unisce agilità, precisione e strategia. 
                                I nostri campi da tennis sono progettati per offrire prestazioni ottimali, con superfici di gioco ben mantenute e strutture di supporto 
                                di prima classe. Che tu sia un principiante curioso di imparare le basi o un giocatore esperto in cerca di una partita competitiva, 
                                troverai tutto ciò di cui hai bisogno per goderti il tennis al massimo.
                            </p>
                            <div class="collegamenti">
                                <a href="attivita.php">
                                    <button>Vai alla pagina del corso</button>
                                </a>
                                <a href="prenota.php">
                                    <button>Prenota un campo</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide 4">
                        <img class="background-slide4" src="immagini/sfondo_index/basket.png">
                        <div class="illustration">
                            <img class="tennis" src="immagini/sfondo_index/basket1.jpg">
                        </div>
                        <div class="info">
                            <h1>BASKET</h1>
                            <p>Dove la passione per il gioco si trasforma in azione e divertimento. 
                                Che tu sia un giocatore esperto in cerca di una partita competitiva o un principiante desideroso di imparare le basi, 
                                troverai tutto ciò di cui hai bisogno per goderti il basket al massimo.
                            </p>
                            <div class="collegamenti">
                                <a href="attivita.php">
                                    <button>Vai alla pagina del corso</button>
                                </a>
                                <a href="prenota.php">
                                    <button>Prenota un campo</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide 5">
                        <img class="background-slide4" src="immagini/sfondo_index/piscina.jpg">
                        <div class="illustration">
                            <img class="tennis" src="immagini/sfondo_index/nuoto1.jpg">
                        </div>
                        <div class="info">
                            <h1>NUOTO</h1>
                            <p>Il nuoto è una passione che ti tiene in forma, ti rilassa e ti rinvigorisce, 
                                tutto mentre ti diverti nell'elemento più puro: l'acqua.
                                Presso il nostro centro, offriamo corsi di nuoto per tutte le età e livelli, con istruttori qualificati pronti a guidarti 
                                in ogni passo del tuo viaggio nel mondo del nuoto.
                            </p>
                            <div class="collegamenti">
                                <a href="attivita.php">
                                    <button>Vai alla pagina del corso</button>
                                </a>
                                <a href="prenota.php">
                                    <button>Prenota un campo</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide 6">
                        <img class="background-slide4" src="immagini/sfondo_index/palestra.png">
                        <div class="illustration">
                            <img class="tennis" src="immagini/sfondo_index/palestra1.jpg">
                        </div>
                        <div class="info">
                            <h1>PALESTRA</h1>
                            <p>Le nostre moderne e attrezzate sale pesi, le aree cardiovascolari e gli spazi per le lezioni collettive sono progettati 
                                per offrirti un'ampia gamma di opzioni di allenamento. Che tu sia un principiante o un atleta esperto, 
                                troverai tutto ciò di cui hai bisogno per raggiungere i tuoi obiettivi di fitness.
                            </p>
                            <div class="collegamenti">
                                <a href="attivita.php">
                                    <button>Vai alla pagina del corso</button>
                                </a>
                                <a href="prenota.php">
                                    <button>Prenota un campo</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="slider-nav">
                        <div class="btn active"></div>
                        <div class="btn"></div>
                        <div class="btn"></div> 
                        <div class="btn"></div>
                        <div class="btn"></div>
                        <div class="btn"></div>              
                    </div>
                </div> 

                <!-- javascript code for sliding -->
                <script type="text/javascript">
                    var slides = document.querySelectorAll('.slide');
                    var btns = document.querySelectorAll('.btn');
                    let currentSlide = 1;

                    //javascript for manual sliding
                    var manualNav = function(manual)
                    {
                        //rimuovo dalle classi non selezionate
                        slides.forEach((slide, i) => 
                        {
                            slide.classList.remove('active');

                            btns.forEach((btn, i) => 
                            {
                                btn.classList.remove('active');
                            });
                        });

                        slides[manual].classList.add('active');
                        btns[manual].classList.add('active');
                    }

                    //quando clicco su un bottone si aggiunge la classe 'active' sia al bottone cliccato che alla slide con stesso indice i
                    btns.forEach((btn, i) => 
                    {
                        btn.addEventListener("click", () => 
                        {
                            manualNav(i);
                            currentSlide = i;
                        });
                    });
                </script>
            </div>
        </div>
                
        <div class="space"></div>
    </main>

    <!-- Footer section with contacts -->	
    <footer>
        <div class="map">
            <!-- Embedding a Google Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.235657742299!2d12.57007927646197!3d41.952273060766345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f64619ddc961d%3A0x997b053d9ac9f023!2sSporting%20Club%20Panda!5e0!3m2!1sit!2sit!4v1714034933636!5m2!1sit!2sit" 
                width="400" height="250" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <hr class="divider">
        <div class="ancora">
            <a href="#beginning"><i class="fas fa-arrow-up"></i></a>		
            <!-- ancora per tornare all'inizio della pagina -->
        </div>

        <div class="contacts">
            <h1>Contattaci</h1>
            <p>
                marino.1984826@studenti.uniroma1.it<br>
                pulsoni.1995669@studenti.uniroma1.it<br>
                ricci.1985803@studenti.uniroma1.it
            </p>
            <p>link alla repository di github</p>
            <hr>
            <!-- Social Media Links -->
            <div class="formalita">
                <div class="cc">&copy; 2024 Sample Website. All Rights Reserved.</div>
                <div class="social">
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-facebook"></i>
                </div>
            </div>
        </div>      
        
    </footer>

</body>
</html>