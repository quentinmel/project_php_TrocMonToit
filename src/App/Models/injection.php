<?php

require_once("connexion.php");

function addUser($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDB();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (lastname, firstname, phone, email, password) VALUES (:lastname, :firstname, :phone, :email, :password, NULL, FALSE)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    closeDB();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirm"];

    if ($password === $password_confirmation) {
        addUser($lastname, $firstname, $phone, $email, $password);
        closeDB();
    } else {
        echo "Les mots de passe ne sont pas identiques";
    }
}

?>