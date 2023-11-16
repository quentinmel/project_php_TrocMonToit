<?php 
require_once("App/Models/injection.php");

function addUsertoDB($lastname, $firstname, $phone, $email, $password, $password_confirmation) {
    if ($password === $password_confirmation) {
        addUser($lastname, $firstname, $phone, $email, $password);
        closeDB();
        header("Location: /");
    } else {
        echo "Les mots de passe ne sont pas identiques";
    }
}

?>