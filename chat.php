<?php 
session_start();
include_once "php/config.php";
if (!isset($_SESSION['id'])) {
  header("location: login_registrazione/login.php");
}
?>
<?php include_once "header.php"; ?>
<head><link rel="stylesheet" href="Style/utente.css"></head>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        
        <a href="login_registrazione/utenteNonGold.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> <!-- va cambiato dinamico -->
        <?php
          $user_id = pg_escape_string($conn, $_GET['user_id']);
          $sql = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$user_id}'");

          if (pg_num_rows($sql) > 0) {
            $row = pg_fetch_assoc($sql);
            $foto_profilo_bytea = $row['foto_profilo'];

            // Se c'è un'immagine di profilo, la decodifichiamo e la mostriamo
            if ($foto_profilo_bytea !== null) {
                // Decodifica i dati bytea
                $foto_decodata = pg_unescape_bytea($foto_profilo_bytea);
                
                // Salva i dati decodificati in un file temporaneo
                $file_temporaneo = tempnam(sys_get_temp_dir(), 'foto_profilo_');
                file_put_contents($file_temporaneo, $foto_decodata);
                
                // Stampa l'immagine 
                echo "<img src='data:image/jpeg;base64," . base64_encode($foto_decodata) . "' alt='Foto Profilo' width='auto' height='200'><br>";
            } else {
                // Se non c'è un'immagine di profilo, mostra un messaggio
                echo '<img src="immagini/photo-camera.png" alt="Immagine di profilo predefinita" width="auto" height="200">';
            }
        } 
        ?>         
        <div class="details">
          <span><?php echo $row['nome']. " " . $row['cognome'] ?></span>
          <p><?php if($row['status'] == true) { echo 'online'; } else { echo 'offline'; }; ?></p>

        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="php/insert-chat.php" method="post"  class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" > <!-- poi rimettici hidden -->
        <input type="text" name="message" class="input-field" placeholder="Scrivi un messaggio qui..." autocomplete="off">
        <button type="submit"><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="js/chat.js" defer></script>

</body>
</html>

