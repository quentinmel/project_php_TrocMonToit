<?php 
require_once("App/Models/queries.php");

session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
</head>
<body>
    <h1>Ma page d'accueil ! Hey !</h1>
    <?php
        if (isset($_SESSION['email'])) {
            echo "<button><a href='/profile'>Profile</a></button>";
        } else {
            echo "<button><a href='/login'>Connexion</a></button>";
        }
    ?>
</body>
</html>