<?php

require_once("connexion.php");

function addUser($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDB();
    $sql = "INSERT INTO users (id, lastname, firstname, phone, email, password, isAdmin) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password', false)";
    $conn->exec($sql);
    closeDB();
}

function addAccommodation($price, $type) {
    $conn = connectDB();
    $sql = "INSERT INTO logements (id, prix, type) VALUES (NULL, '$price', '$type')";
    $conn->exec($sql);
    closeDB();
}

function addPhotos($id, $img_blob) {
    $conn = connectDB();
    $sql = "INSERT INTO photos (id, img_blob, id_location) VALUES (NULL, '$img_blob', '$id')";
    $conn->exec($sql);
    closeDB();
}

?>