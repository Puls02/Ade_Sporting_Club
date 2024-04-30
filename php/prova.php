<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>
    

</head>
<body>
    <form action="app.php" method="post" name="registr"> <!-- importante per i comportamenti automatici del form -->
        <label>Cognome: </label><input type="text" name="cognome" size="40" maxlength="40" required></br>
        <label>Nome: </label><input type="text" name="nome" size="30" maxlength="30" required>
        <input type="submit" value="invia form" >
        <input type="reset" value="reset form">
    </form>
    
</body>
</html>