<?php

require_once("connexion.php");

function addUser($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDB();
    $sql = "INSERT INTO users (id, lastname, firstname, phone, email, password, isAdmin) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password', false)";
    $conn->exec($sql);
    closeDB();
}

function addRenting($address, $nom, $price, $id_type, $description) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings (id, price, address, name, id_type, description) VALUES (NULL, '$price', '$address', '$nom', '$id_type', '$description')";
    $conn->exec($sql);
    $id_renting = $conn->lastInsertId();
    closeDB();

    return $id_renting;
}

function modifyRenting($id, $address, $nom, $price, $id_type, $description) {
    $conn = connectDB();
    $sql = "UPDATE rentings SET price = '$price', address = '$address', name = '$nom', id_type = '$id_type', description = '$description' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB();
}

function addType($name) {
    $conn = connectDB();
    $sql = "INSERT INTO types (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB();
}

function addRentingService($id_renting, $id_services) {
    $conn = connectDB();
    foreach ($id_services as $id_service) {
        $sql = "INSERT INTO rentings_services (id, id_renting, id_service) VALUES (NULL, '$id_renting', '$id_service')";
        $conn->exec($sql);
    }
    closeDB();
}

function addrentingEquipment($id_renting, $id_equipments) {
    $conn = connectDB();
    foreach ($id_equipments as $id_equipment) {
        $sql = "INSERT INTO rentings_equipments (id, id_renting, id_equipment) VALUES (NULL, '$id_renting', '$id_equipment')";
        $conn->exec($sql);
    }
    closeDB();
}

function removerenting($id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings WHERE id = '$id_renting'";
    $conn->exec($sql);
    closeDB();
}

function removeRentingService($id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings_services WHERE id_renting = '$id_renting'";
    $conn->exec($sql);
    closeDB();
}

function removeRentingEquipment($id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings_equipments WHERE id_renting = '$id_renting'";
    $conn->exec($sql);
    closeDB();
}

?>