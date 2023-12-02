<?php

function GetUsers() {
    $conn = connectDB();
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $users = $result->fetchAll();
    closeDB();

    return $users;
}

function GetUserByEmail($email) {
    $conn = connectDB();
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    $user = $result->fetch();
    closeDB();

    return $user;
}

function GetRentings() {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings";
    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB();

    return $rentings;
}

function GetServices() {
    $conn = connectDB();
    $sql = "SELECT * FROM services";
    $result = $conn->query($sql);
    $services = $result->fetchAll();
    closeDB();

    return $services;
}

function GetEquipments() {
    $conn = connectDB();
    $sql = "SELECT * FROM equipments";
    $result = $conn->query($sql);
    $equipments = $result->fetchAll();
    closeDB();

    return $equipments;
}

function GetRentingServices($renting_id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_services WHERE id_renting = '$renting_id'";
    $result = $conn->query($sql);
    $rentings_services = $result->fetchAll();
    closeDB();

    return $rentings_services;
}

function GetRentingEquipments($renting_id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_equipments WHERE id_rentings = '$renting_id'";
    $result = $conn->query($sql);
    $rentings_equipments = $result->fetchAll();
    closeDB();

    return $rentings_equipments;
}

function GetTypes() {
    $conn = connectDB();
    $sql = "SELECT * FROM types";
    $result = $conn->query($sql);
    $types = $result->fetchAll();
    closeDB();

    return $types;
}

function GetRentingsWithDetails() {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            GROUP BY r.id";
    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB();

    return $rentings;
}

function GetRentingWithDetails($id_renting) {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.id) as service_ids, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE r.id = '$id_renting'
            GROUP BY r.id";
    $result = $conn->query($sql);
    $renting = $result->fetch();
    closeDB();

    return $renting;
}

function GetBookingsByUserId($user_id) {
    $conn = connectDB();
    $sql = "SELECT b.*, t.name as type_name, r.price as renting_price, r.address as renting_address, r.id_type as renting_type, r.name as renting_name, r.id as renting_id, r.id_type
            FROM bookings b
            LEFT JOIN rentings r ON b.id_renting = r.id
            LEFT JOIN types t ON r.id_type = t.id
            WHERE b.id_user = '$user_id'";
    $result = $conn->query($sql);
    $bookings = $result->fetchAll();
    closeDB();

    return $bookings;
}

function GetBookedDates($renting_id) {
    $conn = connectDB();
    $sql = "SELECT start_date, end_date FROM bookings WHERE id_renting = '$renting_id'";
    $result = $conn->query($sql);
    $bookings = $result->fetchAll();
    closeDB();

    return $bookings;
}

function GetFavoritesByUserId($user_id) {
    $conn = connectDB();
    $sql = "SELECT f.*, r.price as renting_price, r.address as renting_address, r.id_type as renting_type, r.name as renting_name, r.id as renting_id, r.id_type, r.picture as renting_picture
            FROM favorites f
            LEFT JOIN rentings r ON f.id_renting = r.id
            WHERE f.id_user = '$user_id'";
    $result = $conn->query($sql);
    $favorites = $result->fetchAll();
    closeDB();

    return $favorites;
}