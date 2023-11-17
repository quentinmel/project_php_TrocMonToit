<?php

function GetUser() {
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
    $user = $result->fetchAll();
    closeDB();

    return $user;
}