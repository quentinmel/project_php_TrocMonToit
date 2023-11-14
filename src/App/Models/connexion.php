<?php 

    function getDB() : PDO {
        $servername = "mysql";
        $username = "my_username";
        $password = "my_password";
        $database = "my_database";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
    
?>