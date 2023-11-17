<?php 
require_once("App/Models/queries.php");

session_start();

if (isset($_SESSION["id_session"])) {
    echo "Vous êtes connecté" . '<br>';
    $users = GetUser();

    foreach ($users as $user) {
        echo $user['lastname'] . '<br>';
        echo $user['firstname'] . '<br>';
        echo $user['phone'] . '<br>';
        echo $user['email'] . '<br>';
    }

} else {
    echo "Vous n'êtes pas connecté";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
</head>
<body>
    <h1>Ma page d'accueil ! Hey !</h1>
    <button><a href="/signin">Inscription</a></button>
</body>
</html>