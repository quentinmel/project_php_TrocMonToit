<?php 

    require_once("App/Models/queries.php");

    session_start();
    
    function login($email, $password) {
        $user = GetUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user["password"])) {
                $_SESSION["email"] = $email;
                header("Location: /");
            } else {
                echo "Le mot de passe est incorrect";
            }
        } else {
            echo "L'utilisateur n'existe pas";
        }
    }


?>