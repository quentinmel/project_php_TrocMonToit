<?php

require_once("connexion.php");

function addUser($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDB();
    $sql = "INSERT INTO users (id, lastname, firstname, phone, email, password, isAdmin) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password', false)";
    $conn->exec($sql);
    closeDB();
}

function addRenting($adresse, $nom, $prix, $type, $description) {
    $conn = connectDB();
    $sql = "INSERT INTO locations (id, prix, adresse, nom, type, description) VALUES (NULL, '$prix', '$adresse', '$nom', '$type', '$description')";
    $conn->exec($sql);
    $id_location = $conn->lastInsertId();
    closeDB();

    return $id_location;
}

function modifyRenting($id, $adresse, $nom, $prix, $type, $description) {
    $conn = connectDB();
    $sql = "UPDATE locations SET prix = '$prix', adresse = '$adresse', nom = '$nom', type = '$type', description = '$description' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB();
}

function addLocationService($id_logement, $id_services) {
    $conn = connectDB();
    foreach ($id_services as $id_service) {
        $sql = "INSERT INTO locations_services (id, id_logement, id_service) VALUES (NULL, '$id_logement', '$id_service')";
        $conn->exec($sql);
    }
    closeDB();
}

function addLocationEquipement($id_logement, $id_equipements) {
    $conn = connectDB();
    foreach ($id_equipements as $id_equipement) {
        $sql = "INSERT INTO locations_equipements (id, id_logement, id_equipement) VALUES (NULL, '$id_logement', '$id_equipement')";
        $conn->exec($sql);
    }
    closeDB();
}

function removeLocation($id_logement) {
    $conn = connectDB();
    $sql = "DELETE FROM locations WHERE id = '$id_logement'";
    $conn->exec($sql);
    closeDB();
}

function removeLocationService($id_logement) {
    $conn = connectDB();
    $sql = "DELETE FROM locations_services WHERE id_logement = '$id_logement'";
    $conn->exec($sql);
    closeDB();
}

function removeLocationEquipement($id_logement) {
    $conn = connectDB();
    $sql = "DELETE FROM locations_equipements WHERE id_logement = '$id_logement'";
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