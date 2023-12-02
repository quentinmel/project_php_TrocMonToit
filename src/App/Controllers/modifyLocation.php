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

            $services = isset($_POST["service"]) ? $_POST["service"] : [];
            $equipments = isset($_POST["equipment"]) ? $_POST["equipment"] : [];

            $existingServices = getRentingServices($renting_id);
            foreach ($existingServices as $existingService) {
                if (!in_array($existingService, $services)) {
                    removeRentingService($renting_id);
                }
            }

            foreach ($services as $service) {
                addRentingService($renting_id, $service);
            }

            $existingEquipments = getRentingEquipments($renting_id);
            foreach ($existingEquipments as $existingEquipment) {
                if (!in_array($existingEquipment, $equipments)) {
                    removeRentingEquipment($renting_id);
                }
            }

            foreach ($equipments as $equipment) {
                addRentingEquipment($renting_id, $equipment);
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $maxsize = 55000;
            
                if(($_FILES['image']['size'] >= $maxsize)) {
                    $picture = null;
                    modifyRenting($renting_id, $adresse, $nom, $prix, $type, $picture, $description);
                } else {
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));
                    modifyRenting($renting_id, $adresse, $nom, $prix, $type, $imgContent, $description);
                }
            } else {
                $picture = null;
                modifyRenting($renting_id, $adresse, $nom, $prix, $type, $picture, $description);
            }
    
            header("Location: /admin");
            exit;
        }
    }

?>