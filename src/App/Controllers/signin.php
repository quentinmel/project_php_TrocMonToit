<?php 
require_once("App/Models/injection.php");

unset($_SESSION);
session_start();

function addUsertoDB($lastname, $firstname, $phone, $email, $password, $password_confirmation) {
    if ($password === $password_confirmation) {
        $_SESSION['email'] = $email;
        $password = password_hash($password, PASSWORD_DEFAULT);
        addUser($lastname, $firstname, $phone, $email, $password);
        header("Location: /login");
    } else {
        echo "Les mots de passe ne sont pas identiques";
    }
}

?>