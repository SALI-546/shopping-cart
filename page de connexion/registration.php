<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('config.php');

// Si le formulaire est soumis, insérer les valeurs dans la base de données.
if (isset($_POST['username'])){
    // Supprime les antislashs
    $username = stripslashes($_POST['username']);
    // Échappe les caractères spéciaux dans une chaîne
    $username = mysqli_real_escape_string($conn, $username); 
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $trn_date = date("Y-m-d H:i:s");

    $query = "INSERT INTO `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<div class='form'>
              <h3>Vous êtes inscrit avec succès.</h3>
              <br/>Cliquez ici pour <a href='login.php'>vous connecter</a></div>";
    } else {
        echo "<div class='form'>
              <h3>Erreur lors de l'inscription.</h3>
              <br/>Veuillez réessayer plus tard.</div>";
    }
} else {
?>
<div class="form">
<h1>Inscription</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Nom d'utilisateur" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="S'inscrire" />
</form>
</div>
<?php } ?>
</body>
</html>
