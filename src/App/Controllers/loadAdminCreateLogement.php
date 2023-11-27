<?php
function loadAdminCreateLogement() {
    require_once("App/Models/injection.php");
    require_once("App/Models/queries.php");

    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: /");
        exit;
    }
    $isAdmin = $_SESSION["user"]["isAdmin"];
    if (!$isAdmin) {
        header("Location: /");
        exit;
    }

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/admin_create_logement.html.twig');

    echo $template->display([
        'services' => GetServices(),
        'equipments' => GetEquipments(),
        'types' => GetTypes(),
    ]);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adresse = $_POST["address"];
        $nom = $_POST["name"];
        $prix = $_POST["price"];
        $id_type = $_POST["type"];
        $description = $_POST["description"];
    
        $services = isset($_POST["service"]) ? $_POST["service"] : [];
        $equipments = isset($_POST["equipment"]) ? $_POST["equipment"] : [];

        $id_location = addRenting($adresse, $nom, $prix, $id_type, $description);

        foreach ($services as $service) {
            $service_info = GetServicesById($service);
            if ($service_info) {
                $id_service = $service_info[0]['id'];
                addRentingService($id_location, $id_service);
            }
        }

        foreach ($equipments as $equipment) {
            $equipment_info = GetEquipmentsById($equipment);
            if ($equipment_info) {
                $id_equipment = $equipment_info[0]['id'];
                addRentingEquipment($id_location, $id_equipment);
            }
        }

        header("Location: /admin");
        exit;
    }
}
?>
