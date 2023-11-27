<?php

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
    $sql = "SELECT * FROM locations";
    $result = $conn->query($sql);
    $renting = $result->fetchAll();
    closeDB();

    return $renting;
}

function GetRentingById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM locations WHERE id = '$id'";
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

function GetEquipements() {
    $conn = connectDB();
    $sql = "SELECT * FROM equipements";
    $result = $conn->query($sql);
    $equipements = $result->fetchAll();
    closeDB();

    return $equipements;
}

function GetEquipementsById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM locations_equipements WHERE id = '$id'";
    $result = $conn->query($sql);
    $equipements = $result->fetch();
    closeDB();

    return $equipements;
}

function GetServicesById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM locations_services WHERE id = '$id'";
    $result = $conn->query($sql);
    $services = $result->fetch();
    closeDB();

    return $services;
}

function GetServicesByRentingId($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM locations_services WHERE id_logement = '$id'";
    $result = $conn->query($sql);
    $services = $result->fetch();
    closeDB();

    return $services;
}

function GetEquipementsByRentingId($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM locations_equipements WHERE id_logement = '$id'";
    $result = $conn->query($sql);
    $equipements = $result->fetch();
    closeDB();

    return $equipements;
}