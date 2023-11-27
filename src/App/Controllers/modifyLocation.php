<?php 

    function modifyLocation() {
        require_once 'App/Models/injection.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $renting_id = $_POST["id"];
            $adresse = $_POST["adresse"];
            $nom = $_POST["nom"];
            $prix = $_POST["prix"];
            $type = $_POST["type"];
            $description = $_POST["description"];
    
            modifyRenting($renting_id, $adresse, $nom, $prix, $type, $description);
    
            header("Location: /admin");
            exit;
        }
    }

?>