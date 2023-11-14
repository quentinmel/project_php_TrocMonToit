<?php 

    require_once("/connexion.php");

    function initDatabase() {
        $conn = getDB();
        $conn = (object) $conn;
        $conn->exec("CREATE DATABASE IF NOT EXISTS Users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            lastname VARCHAR(255),
            firstname VARCHAR(255),
            phone VARCHAR(255),
            email VARCHAR(255),
            password VARCHAR(255),
            id_avis INT,
            isAdmin BOOLEAN,
            FOREIGN KEY (id_avis) REFERENCES Avis(id))");
    }


?>