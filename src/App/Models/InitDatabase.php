<?php 

    require_once 'connexion.php';

    function initDatabase() {
        
        $conn = connectDB();

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            lastname TEXT,
            firstname TEXT,
            phone TEXT,
            email TEXT,
            password TEXT,
            isAdmin BOOLEAN);";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS avis (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_user INT,
            note INT,
            commentaire TEXT,
            FOREIGN KEY (id_user) REFERENCES users(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS logements (
            id INT PRIMARY KEY AUTO_INCREMENT,
            type TEXT
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS services (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nom TEXT
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS logservices (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_logement INT,
            id_service INT,
            FOREIGN KEY (id_logement) REFERENCES logements(id),
            FOREIGN KEY (id_service) REFERENCES services(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS equipements (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nom TEXT
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS logequipements (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_logement INT,
            id_equipement INT,
            FOREIGN KEY (id_logement) REFERENCES logements(id),
            FOREIGN KEY (id_equipement) REFERENCES equipements(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS locations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            prix FLOAT,
            addresse TEXT,
            id_logement INT,
            FOREIGN KEY (id_logement) REFERENCES logements(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS photos (
            id INT PRIMARY KEY AUTO_INCREMENT,
            url TEXT,
            id_location INT,
            FOREIGN KEY (id_location) REFERENCES locations(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS reservations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            date_debut DATE,
            date_fin DATE,
            id_user INT,
            id_location INT,
            FOREIGN KEY (id_user) REFERENCES users(id),
            FOREIGN KEY (id_location) REFERENCES locations(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS favoris (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_user INT,
            id_location INT,
            FOREIGN KEY (id_user) REFERENCES users(id),
            FOREIGN KEY (id_location) REFERENCES locations(id)
            );";
        $conn->exec($sql);
    }

?>