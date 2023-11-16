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
    }

?>