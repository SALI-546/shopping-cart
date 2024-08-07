<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('config.php');
session_start();

// Si le formulaire est soumis, vérifier les valeurs dans la base de données.
if (isset($_POST['username'])) {
    // Supprime les antislashs
    $username = stripslashes($_POST['username']);
    // Échappe les caractères spéciaux dans une chaîne
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    // Vérification de l'existence de l'utilisateur dans la base de données
    $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        // Redirection de l'utilisateur vers index.php
        header("Location: index.php");
    } else {
        echo "<div class='form'>
              <h3>Nom d'utilisateur/mot de passe incorrect.</h3>
              <br/>Cliquez ici pour <a href='login.php'>vous connecter</a></div>";
    }
} else {
?>
<div class="form">
<h1>Connexion</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Nom d'utilisateur" required />
<input type="password" name="password" placeholder="Mot de passe" required />
<br>
<input name="submit" type="submit" value="Connexion" />
</form>
<p>Pas encore inscrit ? <a href='registration.php'>Inscrivez-vous ici</a></p>
</div>
<?php } ?>
</body>
</html>
