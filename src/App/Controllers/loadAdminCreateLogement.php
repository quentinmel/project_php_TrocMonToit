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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adresse = $_POST["address"];
        $nom = $_POST["name"];
        $prix = $_POST["price"];
        $id_type = $_POST["type"];
        $description = $_POST["description"];
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    
        $services = isset($_POST["service"]) ? $_POST["service"] : [];
        $equipments = isset($_POST["equipment"]) ? $_POST["equipment"] : [];

        $id_location = addRenting($adresse, $nom, $prix, $id_type, $imgContent, $description);

        foreach ($services as $service) {
            addRentingService($id_location, $service);
        }

        foreach ($equipments as $equipment) {
            addRentingEquipment($id_location, $equipment);
        }

        header("Location: /admin");
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
}
?>
