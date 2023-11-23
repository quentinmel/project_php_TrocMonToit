<?php 

    require_once 'connexion.php';
    require_once 'queries.php';

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
            nom TEXT,
            description TEXT,
            id_logement INT,
            FOREIGN KEY (id_logement) REFERENCES logements(id)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS photos (
            id INT PRIMARY KEY AUTO_INCREMENT,
            img_blob BLOB,
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

       if (GetServices() == null) {
            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Transferts aéroport');";
            $conn->exec($sql);
            
            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Petit-déjeuner');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Service de ménage');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Location de voiture');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Visites guidées');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Cours de cuisine');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, nom) VALUES (NULL, 'Loisirs');";
            $conn->exec($sql);
        }

        if (GetEquipements() == null) {
            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Connexion Wi-Fi');";
            $conn->exec($sql);
            
            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Climatiseur');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Chauffage');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Machine à laver');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Sèche-linge');";
            $conn->exec($sql);

            $sql = "INSERT  INTO equipements (id, nom) VALUES (NULL, 'Télévision');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Fer à repasser');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Nintendo Switch');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'PS5');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Terrasse');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Balcon');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Piscine');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipements (id, nom) VALUES (NULL, 'Jardin');";
            $conn->exec($sql);
        }
    }

?>