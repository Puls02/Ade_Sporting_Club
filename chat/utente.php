
<?php
    session_start();
    include_once "php/config.php";
    if(!isset($_SESSION['ID'])){
      header("location: ../login_registrazione/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="stile.css">
    
</head>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    $query = $pdo->prepare("SELECT * FROM Utente WHERE ID = :ID");
                    $query->execute(array(':ID' => $_SESSION['ID']));
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['Nome'] . " " . $row['Cognome'] ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>
</body>
</html>