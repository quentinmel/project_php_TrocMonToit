<?php
function loadAdminCreateLogement() {
    require_once("App/Models/injection.php");
    require_once("App/Models/queries.php");

    session_start();

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/admin_create_logement.html.twig');

    echo $template->display([
        'services' => GetServices(),
        'equipements' => GetEquipements(),
        'user_connect' => isset($_SESSION["user"]),
    ]);

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
