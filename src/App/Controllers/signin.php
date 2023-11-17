<?php 
require_once("App/Models/injection.php");
require_once("cookieSession.php");

function addUsertoDB($lastname, $firstname, $phone, $email, $password, $password_confirmation) {
    if ($password === $password_confirmation) {
        addSession();
        $password = password_hash($password, PASSWORD_DEFAULT);
        addUser($lastname, $firstname, $phone, $email, $password);
        header("Location: /");
    } else {
        echo "Les mots de passe ne sont pas identiques";
    }
}

?>