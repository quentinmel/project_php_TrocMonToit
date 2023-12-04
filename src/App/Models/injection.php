<?php

require_once("connexion.php");

function addUser($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDB();
    $sql = "INSERT INTO users (id, lastname, firstname, phone, email, password, isAdmin) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password', false)";
    $conn->exec($sql);
    closeDB($conn);
}

function addUserFaker($lastname, $firstname, $phone, $email, $password) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO users (id, lastname, firstname, phone, email, password, isAdmin) VALUES (NULL, '$lastname', '$firstname', '$phone', '$email', '$password', false)";
    $conn->exec($sql);
    closeDB($conn);
}

function addRenting($address, $nom, $price, $id_type, $picture, $description) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings (id, price, address, name, id_type, picture, description) VALUES (NULL, '$price', '$address', '$nom', '$id_type', '$picture','$description')";
    $conn->exec($sql);
    $id_renting = $conn->lastInsertId();
    closeDB($conn);

    return $id_renting;
}

function addRentingFaker($address, $nom, $price, $id_type, $picture, $description) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO rentings (id, price, address, name, id_type, picture, description) VALUES (NULL, '$price', '$address', '$nom', '$id_type', '$picture','$description')";
    $conn->exec($sql);
    $id_renting = $conn->lastInsertId();
    closeDB($conn);

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
    closeDB($conn);
}

function addType($name) {
    $conn = connectDB();
    $sql = "INSERT INTO types (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB($conn);
}

function addTypeFaker($name) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO types (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB($conn);
}

function addEquipment($name) {
    $conn = connectDB();
    $sql = "INSERT INTO equipments (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB($conn);
}

function addEquipmentFaker($name) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO equipments (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB($conn);
}

function addService($name) {
    $conn = connectDB();
    $sql = "INSERT INTO services (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB($conn);
}

function addServiceFaker($name) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO services (id, name) VALUES (NULL, '$name')";
    $conn->exec($sql);
    closeDB($conn);
}

function addRentingService($id_renting, $id_service) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings_services (id, id_renting, id_service) VALUES (NULL, '$id_renting', '$id_service')";
    $conn->exec($sql);
    closeDB($conn);
}

function addrentingEquipment($id_renting, $id_equipment) {
    $conn = connectDB();
    $sql = "INSERT INTO rentings_equipments (id, id_rentings, id_equipment) VALUES (NULL, '$id_renting', '$id_equipment')";
    $conn->exec($sql);
    closeDB($conn);
}

function addRentingEquipmentFaker($id_renting, $id_equipment) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO rentings_equipments (id, id_rentings, id_equipment) VALUES (NULL, '$id_renting', '$id_equipment')";
    $conn->exec($sql);
    closeDB($conn);
}

function addRentingServiceFaker($id_renting, $id_service) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO rentings_services (id, id_renting, id_service) VALUES (NULL, '$id_renting', '$id_service')";
    $conn->exec($sql);
    closeDB($conn);
}

function removerenting($id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings WHERE id = '$id_renting'";
    $conn->exec($sql);
    closeDB($conn);
}

function removeRentingService($id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings_services WHERE id_renting = '$id_renting'";
    $conn->exec($sql);
    closeDB($conn);
}

function removeRentingEquipment($id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM rentings_equipments WHERE id_rentings = '$id_renting'";
    $conn->exec($sql);
    closeDB($conn);
}

function addBooking($start_date, $end_date, $id_user, $id_renting) {
    $conn = connectDB();
    $sql = "INSERT INTO bookings (id, start_date, end_date, id_user, id_renting) VALUES (NULL, '$start_date', '$end_date', '$id_user', '$id_renting')";
    $conn->exec($sql);
    closeDB($conn);
}

function addBookingFaker($start_date, $end_date, $id_user, $id_renting) {
    $conn = connectDBFaker();
    $sql = "INSERT INTO bookings (id, start_date, end_date, id_user, id_renting) VALUES (NULL, '$start_date', '$end_date', '$id_user', '$id_renting')";
    $conn->exec($sql);
    closeDB($conn);
}

function addFavorite($id_user, $id_renting) {
    $conn = connectDB();
    $sql = "INSERT INTO favorites (id, id_user, id_renting) VALUES (NULL, '$id_user', '$id_renting')";
    $conn->exec($sql);
    closeDB($conn);
}

function removeFavorite($id_user, $id_renting) {
    $conn = connectDB();
    $sql = "DELETE FROM favorites WHERE id_user = '$id_user' AND id_renting = '$id_renting'";
    $conn->exec($sql);
    closeDB($conn);
}

function removeEquipment($id) {
    $conn = connectDB();
    
    $sql1 = "DELETE FROM rentings_equipments WHERE id_equipment = '$id'";
    $conn->exec($sql1);
    
    $sql2 = "DELETE FROM equipments WHERE id = '$id'";
    $conn->exec($sql2);
    
    closeDB($conn);
}

function removeService($id_service) {
    $conn = connectDB();

    $sql1 = "DELETE FROM rentings_services WHERE id_service = '$id_service'";
    $conn->exec($sql1);

    $sql2 = "DELETE FROM services WHERE id = '$id_service'";
    $conn->exec($sql2);

    closeDB($conn);
}

function modifyEquipment($id, $name) {
    $conn = connectDB();
    $sql = "UPDATE equipments SET name = '$name' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function modifyService($id, $name) {
    $conn = connectDB();
    $sql = "UPDATE services SET name = '$name' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function updateUserLastName($id, $lastname) {
    $conn = connectDB();
    $sql = "UPDATE users SET lastname = '$lastname' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function updateUserFirstName($id, $firstname) {
    $conn = connectDB();
    $sql = "UPDATE users SET firstname = '$firstname' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function updateUserPhone($id, $phone) {
    $conn = connectDB();
    $sql = "UPDATE users SET phone = '$phone' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function updateUserEmail($id, $email) {
    $conn = connectDB();
    $sql = "UPDATE users SET email = '$email' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function updateUserPassword($id, $password) {
    $conn = connectDB();
    $sql = "UPDATE users SET password = '$password' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function updateUserIsAdmin($id, $isAdmin) {
    $conn = connectDB();
    $sql = "UPDATE users SET isAdmin = '$isAdmin' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function removeUser($id) {
    $conn = connectDB();
    $sql = "DELETE FROM users WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function removeFavoriteUser($id) {
    $conn = connectDB();
    $sql = "DELETE FROM favorites WHERE id_user = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}
function removeBookingUser($id) {
    $conn = connectDB();
    $sql = "DELETE FROM bookings WHERE id_user = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function removeType($id) {
    $conn = connectDB();
    $sql = "DELETE FROM types WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

function modifyType($id, $name) {
    $conn = connectDB();
    $sql = "UPDATE types SET name = '$name' WHERE id = '$id'";
    $conn->exec($sql);
    closeDB($conn);
}

?>