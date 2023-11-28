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

function GetRenting() {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings";
    $result = $conn->query($sql);
    $renting = $result->fetchAll();
    closeDB();

    return $renting;
}

function GetRentingById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings WHERE id = '$id'";
    $result = $conn->query($sql);
    $renting = $result->fetch();
    closeDB();

    return $renting;
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

function GetRentingServices() {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_services";
    $result = $conn->query($sql);
    $rentings_services = $result->fetchAll();
    closeDB();

    return $rentings_services;
}

function GetRentingEquipments() {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_equipments";
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