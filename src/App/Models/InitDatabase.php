<?php 

    require_once 'connexion.php';

    function initDatabase() {
        
        $conn = connectDB();
        $sql = "CREATE TABLE IF NOT EXISTS avis (
            id INT PRIMARY KEY AUTO_INCREMENT,
            note INT,
            commentaire TEXT
            );";
        $conn->exec($sql);
        
        $conn->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            lastname VARCHAR(255),
            firstname VARCHAR(255),
            phone VARCHAR(255),
            email VARCHAR(255),
            password VARCHAR(255),
            id_avis INT,
            isAdmin BOOLEAN,
            FOREIGN KEY (id_avis) REFERENCES avis(id))");
    }

?>