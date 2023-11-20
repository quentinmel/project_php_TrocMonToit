<?php 
require_once("App/Models/queries.php");

session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php
        require_once("App/Models/queries.php");

        if (isset($_SESSION['email'])) {
            echo "<button><a href='/profile'>Profile</a></button>";
        } else {
            echo "<button><a href='/login'>Connexion</a></button>";
        }

        foreach (GetRenting() as $renting) {
            echo '<div class="renting">';
            echo "<h2>" . $renting['addresse'] . "</h2>";
            echo "<p> Prix : " . $renting['prix'] . "€</p>";
            echo "<p> Type : " . GetAccommodation()[$renting['id_logement'] - 1]['type'] . "</p>";
            echo '</div>';
        }
    ?>
</body>
</html>