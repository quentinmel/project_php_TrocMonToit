<?php 

    function connectDB() {
        $servername = "mysql";
        $username = "my_user";
        $password = "my_password";
        $database = "my_database";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            return $conn;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            error_log($e->getMessage());
        }

    }

    function connectDBFaker() {
        $servername = "127.0.0.1";
        $username = "my_user";
        $password = "my_password";
        $database = "my_database";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            return $conn;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            error_log($e->getMessage());
        }

    }

    function closeDB($conn) {
        $conn = null;
    }
    
?>