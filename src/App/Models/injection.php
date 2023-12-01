<?php

require_once("connexion.php");

function addUser($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDB();
    $sql = "INSERT INTO users (id, lastname, firstname, phone, email, password, isAdmin) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password', false)";
    $conn->exec($sql);
    closeDB();
}

function addRenting($address, $nom, $price, $id_type, $picture, $description) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings (id, price, address, name, id_type, picture, description) VALUES (NULL, '$price', '$address', '$nom', '$id_type', '$picture','$description')";
    $conn->exec($sql);
    $id_renting = $conn->lastInsertId();
    closeDB();

    return $id_renting;
}

function modifyRenting($id, $address, $nom, $price, $id_type, $picture, $description) {
    $conn = connectDB();
    if ($picture == null) {
    	$sql = "UPDATE rentings SET price = '$price', address = '$address', name = '$nom', id_type = '$id_type', description = '$description' WHERE id = '$id'";
    } else {
        $sql = "UPDATE rentings SET price = '$price', address = '$address', name = '$nom', id_type = '$id_type', picture = '$picture', description = '$description' WHERE id = '$id'";
    }
    $conn->exec($sql);
    closeDB();
}

function addType($name) {
    $conn = connectDB();
    $sql = "INSERT INTO types (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB();
}

function addEquipment($name) {
    $conn = connectDB();
    $sql = "INSERT INTO equipments (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB();
}

function addService($name) {
    $conn = connectDB();
    $sql = "INSERT INTO services (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB();
}

function addRentingService($id_renting, $id_service) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings_services (id, id_renting, id_service) VALUES (NULL, '$id_renting', '$id_service')";
    $conn->exec($sql);
    closeDB();
}

function addrentingEquipment($id_renting, $id_equipment) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings_equipments (id, id_rentings, id_equipment) VALUES (NULL, '$id_renting', '$id_equipment')";
    $conn->exec($sql);
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
    $sql = "DELETE FROM rentings_equipments WHERE id_rentings = '$id_renting'";
    $conn->exec($sql);
    closeDB();
}

function addBooking($start_date, $end_date, $id_user, $id_renting) {
    $conn = connectDB();
    $sql = "INSERT INTO bookings (id, start_date, end_date, id_user, id_renting) VALUES (NULL, '$start_date', '$end_date', '$id_user', '$id_renting')";
    $conn->exec($sql);
    closeDB();
}

function addFavorite($id_user, $id_renting) {
    $conn = connectDB();
    $sql = "INSERT INTO favorites (id, id_user, id_renting) VALUES (NULL, '$id_user', '$id_renting')";
    $conn->exec($sql);
    closeDB();
}

function removeFavorite($id_user, $id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM favorites WHERE id_user = '$id_user' AND id_renting = '$id_renting'";
    $conn->exec($sql);
    closeDB();
}

function removeEquipment($id) {
    $conn = connectDB();
    
    $sql1 = "DELETE FROM rentings_equipments WHERE id_equipment = '$id'";
    $conn->exec($sql1);
    
    $sql2 = "DELETE FROM equipments WHERE id = '$id'";
    $conn->exec($sql2);
    
    closeDB();
}


function removeService($id_service) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings_services WHERE id_service = '$id_service'";
    $conn->exec($sql);
    closeDB();
}

function modifyEquipment($id, $name) {
    $conn = connectDB();
    $sql = "UPDATE equipments SET name = '$name' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB();
}

?>