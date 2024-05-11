<?php 
session_start();
include_once "php/config.php";
if (!isset($_SESSION['id'])) {
  header("location: login_registrazione/login.php");
}
?>
<?php include_once "header.php"; ?>
<style>
  /* Chat Area CSS Start */
.chat-area header{
  display: flex;
  align-items: center;
  padding: 18px 30px;
}
.chat-area header .back-icon{
  color: #333;
  font-size: 18px;
}
.chat-area header img{
  height: 45px;
  width: 45px;
  margin: 0 15px;
}
.chat-area header .details span{
  font-size: 17px;
  font-weight: 500;
}
.chat-box{
  position: relative;
  min-height: 500px;
  max-height: 500px;
  overflow-y: auto;
  padding: 10px 30px 20px 30px;
  background: #f7f7f7;
  box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
              inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}
.chat-box .text{
  position: absolute;
  top: 45%;
  left: 50%;
  width: calc(100% - 50px);
  text-align: center;
  transform: translate(-50%, -50%);
}
.chat-box .chat{
  margin: 15px 0;
}
.chat-box .chat p{
  word-wrap: break-word;
  padding: 8px 16px;
  box-shadow: 0 0 32px rgb(0 0 0 / 8%),
              0rem 16px 16px -16px rgb(0 0 0 / 10%);
}
.chat-box .outgoing{
  display: flex;
}
.chat-box .outgoing .details{
  margin-left: auto;
  max-width: calc(100% - 130px);
}
.outgoing .details p{
  background: #333;
  color: #fff;
  border-radius: 18px 18px 0 18px;
}
.chat-box .incoming{
  display: flex;
  align-items: flex-end;
}
.chat-box .incoming img{
  height: 35px;
  width: 35px;
}
.chat-box .incoming .details{
  margin-right: auto;
  margin-left: 10px;
  max-width: calc(100% - 130px);
}
.incoming .details p{
  background: #fff;
  color: #333;
  border-radius: 18px 18px 18px 0;
}
.typing-area{
  padding: 18px 30px;
  display: flex;
  justify-content: space-between;
}
.typing-area input{
  height: 45px;
  width: calc(100% - 58px);
  font-size: 16px;
  padding: 0 13px;
  border: 1px solid #e6e6e6;
  outline: none;
  border-radius: 5px 0 0 5px;
}
.typing-area button{
  color: #fff;
  width: 55px;
  border: none;
  outline: none;
  background: #333;
  font-size: 19px;
  cursor: pointer;
  opacity: 0.7;
  pointer-events: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
}
.typing-area button.active{
  opacity: 1;
  pointer-events: auto;
}
</style>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = pg_escape_string($conn, $_GET['user_id']);
          $sql = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$user_id}'");
          if (pg_num_rows($sql) > 0) {
            $row = pg_fetch_assoc($sql);
          } else {
            header("location: php/users.php");
          }
        ?>
        <a href="login_registrazione/utenteNonGold.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> <!-- va cambiato dinamico -->
        <?php
          $result = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$_SESSION['id']}'");

          if (pg_num_rows($result) > 0) {
          $row = pg_fetch_assoc($result);
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
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Scrivi un messaggio qui..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="js/chat.js"></script>

</body>
</html>

