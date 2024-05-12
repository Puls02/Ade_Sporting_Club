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
          // Verifica se l'utente ha un'immagine di profilo
          if (isset($row['Foto_profilo']) && $row['Foto_profilo'] !== null) {
            // L'utente ha un'immagine di profilo, visualizzala
            $immagine_codificata = base64_encode($row['Foto_profilo']);
            echo '<img src="data:image/jpeg;base64,'.$immagine_codificata.'" />';
          } else {
            // Nessuna immagine di profilo per questo utente, mostra l'immagine predefinita
            echo '<img src="immagini/photo-camera.png" alt="Immagine di profilo predefinita" />';
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
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" > <!-- poi rimettici hidden -->
        <input type="text" name="message" class="input-field" placeholder="Scrivi un messaggio qui..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="js/chat.js" defer></script>

</body>
</html>

