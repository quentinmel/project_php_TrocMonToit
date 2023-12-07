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

        $sql = "CREATE TABLE IF NOT EXISTS types (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name TEXT
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS rentings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            price FLOAT,
            address TEXT,
            name TEXT,
            id_type INT,
            picture BLOB,
            description TEXT,
            FOREIGN KEY (id_type) REFERENCES types(ID)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS services (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name TEXT
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS rentings_services (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_renting INT,
            id_service INT,
            FOREIGN KEY (id_renting) REFERENCES rentings(ID),
            FOREIGN KEY (id_service) REFERENCES services(ID)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS equipments (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name TEXT
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS rentings_equipments (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_rentings INT,
            id_equipment INT,
            FOREIGN KEY (id_rentings) REFERENCES rentings(ID),
            FOREIGN KEY (id_equipment) REFERENCES equipments(ID)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS bookings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            start_date DATE,
            end_date DATE,
            id_user INT,
            id_renting INT,
            FOREIGN KEY (id_user) REFERENCES users(ID),
            FOREIGN KEY (id_renting) REFERENCES rentings(ID)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS reviews (
            id INT PRIMARY KEY AUTO_INCREMENT,
            rating INT,
            comment TEXT,
            renting_name TEXT,
            id_user INT,
            id_renting INT,
            id_booking INT,
            FOREIGN KEY (id_user) REFERENCES users(ID),
            FOREIGN KEY (id_renting) REFERENCES rentings(ID),
            FOREIGN KEY (id_booking) REFERENCES bookings(ID)
            );";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS favorites (
            id INT PRIMARY KEY AUTO_INCREMENT,
            id_user INT,
            id_renting INT,
            FOREIGN KEY (id_user) REFERENCES users(ID),
            FOREIGN KEY (id_renting) REFERENCES rentings(ID)
            );";
        $conn->exec($sql);

       if (GetServices() == null) {
            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Transferts aéroport');";
            $conn->exec($sql);
            
            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Petit-déjeuner');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Service de ménage');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Location de voiture');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Visites guidées');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Cours de cuisine');";
            $conn->exec($sql);

            $sql = "INSERT INTO services (id, name) VALUES (NULL, 'Loisirs');";
            $conn->exec($sql);
        }

        if (GetEquipments() == null) {
            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Connexion Wi-Fi');";
            $conn->exec($sql);
            
            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Climatiseur');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Chauffage');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Machine à laver');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Sèche-linge');";
            $conn->exec($sql);

            $sql = "INSERT  INTO equipments (id, name) VALUES (NULL, 'Télévision');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Fer à repasser');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Nintendo Switch');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'PS5');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Terrasse');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Balcon');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Piscine');";
            $conn->exec($sql);

            $sql = "INSERT INTO equipments (id, name) VALUES (NULL, 'Jardin');";
            $conn->exec($sql);
        }

        if (GetTypes() == null) {
            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Appartement');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Maison');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Chalet');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Villa');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Péniche');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Yourte');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Cabane');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Igloo');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Tente');";
            $conn->exec($sql);

            $sql = "INSERT INTO types (id, name) VALUES (NULL, 'Car');";
            $conn->exec($sql);
        }
    }

?>