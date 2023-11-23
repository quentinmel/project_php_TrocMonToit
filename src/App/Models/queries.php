<?php

function GetUserByEmail($email) {
    $conn = connectDB();
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    $user = $result->fetch();
    closeDB();

    return $user;
}

function GetAccommodation() {
    $conn = connectDB();
    $sql = "SELECT * FROM logements";
    $result = $conn->query($sql);
    $accommodation = $result->fetchAll();
    closeDB();

    return $accommodation;
}

function GetRenting() {
    $conn = connectDB();
    $sql = "SELECT * FROM locations";
    $result = $conn->query($sql);
    $renting = $result->fetchAll();
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
