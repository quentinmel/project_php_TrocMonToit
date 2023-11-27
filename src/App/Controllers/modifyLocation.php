<?php 

    function modifyLocation() {
        require_once 'App/Models/injection.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $renting_id = $_POST["id"];
            $adresse = $_POST["address"];
            $nom = $_POST["name"];
            $prix = $_POST["price"];
            $type = $_POST["type"];
            $description = $_POST["description"];
    
            modifyRenting($renting_id, $adresse, $nom, $prix, $type, $description);
    
            header("Location: /admin");
            exit;
        }
    }

?>