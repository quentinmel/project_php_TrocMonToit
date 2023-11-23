<?php
function adminLogement() {
    require_once("App/Models/injection.php");
    require_once("App/Models/queries.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adresse = $_POST["adresse"];
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $type = $_POST["type"];
        $description = $_POST["description"];
    
        $services = isset($_POST["service"]) ? $_POST["service"] : [];
        $equipements = isset($_POST["equipement"]) ? $_POST["equipement"] : [];

        $id_location = addRenting($adresse, $nom, $prix, $type, $description);

        foreach ($services as $service) {
            $service_info = GetServicesById($service);
            if ($service_info) {
                $id_service = $service_info[0]['id'];
                addLocationService($id_location, $id_service);
            }
        }

        foreach ($equipements as $equipement) {
            $equipement_info = GetEquipementsById($equipement);
            if ($equipement_info) {
                $id_equipement = $equipement_info[0]['id'];
                addLocationEquipement($id_location, $id_equipement);
            }
        }

        header("Location: /admin");
        exit;
    }
}
?>
