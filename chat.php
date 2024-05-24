<?php 
session_start();
include_once "php/config.php";
if (!isset($_SESSION['id'])) {
  header("location: login_registrazione/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- It is used to insert an icon in the title. We generated the icon from the site https://www.favicon-generator.org/ -->
    <link rel="icon" type="image/png" sizes="32x32" href="immagini/logo/favicon2.png">
    <title>Ade Sporting Club</title>

    <!-- Link to style folder -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/utente.css">

</head>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        
        <a href="#" class="back-icon" onclick="window.parent.postMessage('closeChat', '*')"><i class="fas fa-arrow-left"></i></a> <!-- va cambiato dinamico -->
        <?php
          $user_id = pg_escape_string($conn, $_GET['user_id']);

          if ($user_id < 30) {
            $query = "SELECT * FROM Istruttore WHERE id = '{$user_id}'";
          } else {
            $query = "SELECT * FROM Utente WHERE id = '{$user_id}'";
          }

          $sql = pg_query($conn, $query);

          if (pg_num_rows($sql) > 0) {
            $row = pg_fetch_assoc($sql);
            $foto_profilo_bytea = $row['foto_profilo'];

            //If there is a profile picture, we decode it and display it, otherwise we show a default photo
            if ($foto_profilo_bytea !== null) {
                //Decodes bytea data and print the image
                $foto_decodata = pg_unescape_bytea($foto_profilo_bytea);
                echo "<img src='data:image/jpeg;base64," . base64_encode($foto_decodata) . "' alt='Foto Profilo' width='auto' height='200'><br>";
            } else {
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
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Scrivi un messaggio qui..." autocomplete="off">
        <button type="submit"><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="js/chat.js" defer></script>

</body>
</html>

