<?php 

require_once("App/Models/queries.php");

session_start();

if (isset($_SESSION['email'])) {
    echo "Vous êtes connecté" . '<br>';
    $user = GetUserByEmail($_SESSION['email']);
        echo 'Nom : ' . $user['lastname'] . '<br>';
        echo 'Prénom : ' . $user['firstname'] . '<br>';
        echo 'Numéro de téléphone : ' . $user['phone'] . '<br>';
        echo 'Adresse mail : ' . $user['email'] . '<br>';

} else {
    echo "Vous n'êtes pas connecté";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <button><a href="/disconnect">Déconnexion</a></button>
</body>
</html>
