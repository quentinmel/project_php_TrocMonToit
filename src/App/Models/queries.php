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

function GetequipmentsById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_equipments WHERE id = '$id'";
    $result = $conn->query($sql);
    $equipments = $result->fetch();
    closeDB();

    return $equipments;
}

function GetServicesById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_services WHERE id = '$id'";
    $result = $conn->query($sql);
    $services = $result->fetch();
    closeDB();

    return $services;
}

function GetServicesByRentingId($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_services WHERE id_renting = '$id'";
    $result = $conn->query($sql);
    $services = $result->fetch();
    closeDB();

    return $services;
}

function GetequipmentsByRentingId($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_equipments WHERE id_renting = '$id'";
    $result = $conn->query($sql);
    $equipments = $result->fetch();
    closeDB();

    return $equipments;
}